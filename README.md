![CPNV joutes logo](https://github.com/CPNV-ES/Joutes/blob/master/wiki/logo-black.png)

# Joutes

Every year in June the CPNV physical education teachers organise a sports jousting tournament.  
There are badminton, beach volleyball, unihockey, basketball tournaments, all kinds of team sports including pétanque and a hike!  
These tournaments are competitions: there are matches, winners and losers, rankings and winners.  
The Joutes application:

-   Allows students to register to participate in the different tournaments.
-   Help teachers organise the tournaments: matches, courts, time, referee, ... This is no trivial task as a tournament can have several pools, phases, semi-finals, cross-over finals and all sorts of different formulas depending on the number of participants and the sport chosen.
-   Allows to record all the scores of each game to establish the ranking.

## Start developping

You can find an installation procedure [here](https://github.com/CPNV-ES/Joutes-2020/wiki/Proc%C3%A9dure-d'installation)

## Documentation

You can find the documentation [here](https://github.com/CPNV-ES/Joutes-2020/wiki)

## Laravel sail

You can find the documentation [here](https://laravel.com/docs/8.x/sail#configuring-a-bash-alias)

### Quick tips

Installing Composer Dependencies For Existing Applications

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

Instead of repeatedly typing vendor/bin/sail to execute Sail commands, you may wish to configure a Bash alias that allows you to execute Sail's commands more easily

```bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

Starting & Stopping Sail

```bash
sail up -d
sail stop
```

Executing Composer Commands

```bash
sail composer require laravel/sanctum
```

Executing PHP Commands

```bash
# Running Artisan commands locally...
php artisan queue:work

# Running Artisan commands within Laravel Sail...
sail artisan queue:work
```
