<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class UserPromote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:promote {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Promote a user to Admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::where('email', '=', $this->argument('email'))->first();

        if (!$user) {
            $this->error('User not found.');
            return 1;
        }

        $adminRole = Role::where('Name', '=', 'Admin')->first();

        if (!$adminRole) {
            $this->error('Admin role not found.');
        }

        $user->roles()->attach($adminRole->id);
        Cache::clear('users:id:' . $user->id . ':isAdmin');
        Cache::clear('users:id:' . $user->id);

        $this->info('User {$user->Name} promoted to Admin.');
    }
}
