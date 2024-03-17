<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin', 'title' => 'Gatekeeper', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Moderator', 'title' => 'Sentinel', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Help Desk', 'title' => 'Echo', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('roles')->insert($roles);
    }
}
