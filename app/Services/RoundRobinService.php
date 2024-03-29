<?php

/**
 * @url https://github.com/tony98ms/laravel-round-robin
 */

namespace App\Services;

use Exception;
use Illuminate\Support\Collection;

class RoundRobinService
{

    const MIN_TEAMS  = 2;

    /**
     * Teams to get Schedule
     *
     * @var Collection
     */
    protected Collection $teams;
    /**
     * Schedule
     *
     * @var Collection
     */
    protected Collection $schedule;
    /**
     * Shuffle
     *
     * @var boolean
     */
    protected bool $shuffle = true;
    /**
     * @var int|null
     */
    protected $seed = null;
    /**
     * @var int|null How many rounds to generate
     */
    protected $rounds = null;
    /**
     * Get the teams to generate schedule
     *
     * @param array $teams
     */
    private function __construct(Collection $teams)
    {
        $this->teams = $teams;
        $this->schedule = collect();
    }
    private static function addTeams(Collection $teams): RoundRobinService
    {
        if (empty($teams) || count($teams) < self::MIN_TEAMS) {
            throw new Exception('You need at least 2 teams to generate the schedule.');
        }
        $instance = new static($teams);
        return $instance;
    }
    /**
     * Generate schedule
     *
     * @return Collection
     */
    private function schedule(): Collection
    {
        if ($this->teams->isEmpty() || $this->teams->count() < self::MIN_TEAMS) {
            throw new Exception('You need at least 2 teams to generate the schedule.');
        }
        $this->checkForOdd();
        $this->doShuffle();
        $this->buildSchedule();
        $this->cleanSchedule();

        return $this->schedule;
    }
    /**
     * Generate the schedule in a single function.
     *
     * @param Collection $teams
     * @param integer|null $rounds
     * @param boolean $shuffle
     * @param boolean $doubleRound
     * @return Collection
     */
    public static function makeSchedule(Collection $teams, int $rounds = null, bool $shuffle = true, int $seed = null, bool $doubleRound = false): Collection
    {
        $instance = static::addTeams($teams);
        if (!is_null($rounds)) {
            $instance->rounds = $rounds;
        }
        if (!is_null($seed)) {
            $instance->seed = $seed;
        }
        if ($doubleRound) {
            $instance->doubleRound();
        }
        return $instance->schedule();
    }
    /**
     * Check if there are odd numbers of teams.
     *
     * @return void
     */
    protected function checkForOdd(): void
    {
        if ($this->teams->count() % 2 === 1) {
            $this->teams->push(null);
        }
    }
    /**
     * Shuffle teams.
     *
     * @return void
     */
    protected function doShuffle(): void
    {
        if ($this->shuffle) {
            $this->teams = collect($this->teams->shuffle($this->seed));
        }
    }

    protected function doubleRound()
    {
        $this->rounds = (($count = $this->teams->count()) % 2 === 0 ? $count - 1 : $count) * 2;

        return $this;
    }

    /**
     * Generate Schedule
     *
     * @return RoundRobinService
     */
    protected function buildSchedule(): RoundRobinService
    {
        $teamsCount = $this->teams->count();
        $halfTeamCount = $teamsCount / 2;
        $rounds = $this->rounds ?? $teamsCount - 1;
        for ($round = 1; $round <= $rounds; $round += 1) {
            $fase = $round > ($teamsCount - 1) ? 'way' :  'one';
            $this->schedule[$round] = collect();
            $this->teams->each(function ($team, $index) use ($halfTeamCount, $round, $fase) {
                if ($index >= $halfTeamCount) {
                    return false;
                }
                $team1 = $team;
                $team2 = $this->teams[$index + $halfTeamCount];
                $matchup = $round % 2 === 0 ? collect(['phase' =>  $fase, 'round' => $round, 'local' => $team1, 'visitor' => $team2]) : collect(['phase' =>  $fase, 'round' => $round, 'local' => $team2, 'visitor' => $team1]);
                $this->schedule[$round]->push($matchup);
            });
            $this->rotate();
        }
        return $this;
    }
    /**
     * Rotate array items according to the round-robin algorithm.
     *
     * @return RoundRobinService
     */
    protected function rotate(): RoundRobinService
    {
        $teamsCount = $this->teams->count();
        if ($teamsCount < 3) {
            return $this;
        }
        $lastIndex = $teamsCount - 1;
        $factor = (int) ($teamsCount % 2 === 0 ? $teamsCount / 2 : ($teamsCount / 2) + 1);
        $topRightIndex = $factor - 1;
        $topRightItem = $this->teams[$topRightIndex];
        $bottomLeftIndex = $factor;
        $bottomLeftItem = $this->teams[$bottomLeftIndex];
        for ($i = $topRightIndex; $i > 0; $i -= 1) {
            $this->teams[$i] = $this->teams[$i - 1];
        }
        for ($i = $bottomLeftIndex; $i < $lastIndex; $i += 1) {
            $this->teams[$i] = $this->teams[$i + 1];
        }
        $this->teams[1] = $bottomLeftItem;
        $this->teams[$lastIndex] = $topRightItem;

        return $this;
    }
    /**
     * Eliminate all matches where they have an empty team.
     *
     * @return RoundRobinService
     */
    protected function cleanSchedule(): RoundRobinService
    {
        $this->schedule = $this->schedule->transform(function ($rounds, $key) {
            return $rounds->filter(function ($round) {
                return !is_null($round->get('local')) && !is_null($round->get('visitor'));
            })->values();
        })->values();
        return $this;
    }
    /**
     * Shuffle teams
     *
     * @return RoundRobinService
     */
    protected function shuffle($seed = null)
    {
        $this->shuffle = true;
        $this->seed = $seed;

        return $this;
    }
    /**
     * Do not shuffle teams
     *
     * @return RoundRobinService
     */
    protected function doNotShuffle()
    {
        $this->shuffle = false;

        return $this;
    }
}
