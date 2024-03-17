<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Socials extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socials = [
            ['name' => 'Twitter', 'image' => 'fa-brands fa-square-x-twitter', 'base_url' => 'https://twitter.com/', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Facebook', 'image' => 'fa-brands fa-facebook', 'base_url' => 'https://facebook.com/', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Instagram', 'image' => 'fa-brands fa-instagram', 'base_url' => 'https://instagram.com/', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Linkedin', 'image' => 'fa-brands fa-linkedin', 'base_url' => 'https://linkedin.com/', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('socials')->insert($socials);
    }
}
