<?php

namespace App\Console\Commands;

use App\Console\Commands\FILE_APPEND;
use App\Models\Role;
use App\User;
use Illuminate\Console\Command;

class MakeDevLogin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:devLogin {username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set the user up for the devLogin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $username = $this->argument('username');

        if(User::where('username', '=', $username)->exists()){

            $user = User::where('username', $username)->first();
            $role = Role::where('slug', 'ADMIN')->first();
            $user->password = '$2y$10$N3.inGmrPoTZ.HMps9Lk7u8/xS5Mh7qf1v/DxdBw5us78jLBYBh8.';
            $user->role()->associate($role);
            $user->save();

            $filePath = '.env';
            $envUserId = env('USER_ID');
            if ($envUserId){
                file_put_contents($filePath, str_replace('USER_ID = '.$envUserId.'', 'USER_ID = '.$user->id.'', file_get_contents($filePath)));
            }else{
                file_put_contents($filePath, PHP_EOL.'# Dev-login'.PHP_EOL, FILE_APPEND);
                file_put_contents($filePath, 'USER_ID = '.$user->id.'', FILE_APPEND);
            }


            $this->line("The user '$username' is ready for the devlogin");

        }else{
            $this->line("Error: The user '$username' doesn't exist");
        }
    }
}
