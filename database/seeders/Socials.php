<?php

namespace Database\Seeders;

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
            ['name' => 'Twitter', 'image' => 'fa-brands fa-square-x-twitter', 'base_url' => 'https://twitter.com/{id}', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Facebook', 'image' => 'fa-brands fa-facebook', 'base_url' => 'https://facebook.com/{id}', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Instagram', 'image' => 'fa-brands fa-instagram', 'base_url' => 'https://instagram.com/{id}', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Linkedin', 'image' => 'fa-brands fa-linkedin', 'base_url' => 'https://linkedin.com/{id}', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'YouTube', 'image' => 'fa-brands fa-youtube', 'base_url' => 'https://youtube.com/{id}', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Twitch', 'image' => 'fa-brands fa-twitch', 'base_url' => 'https://twitch.com/{id}', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Amazon Author Page', 'image' => 'fa-brands fa-amazon', 'base_url' => 'https://amazon.com/{id}', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Website', 'image' => 'fa-sharp fa-regular fa-globe', 'base_url' => '{id}', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Other Social Media', 'image' => 'fa-sharp fa-regular fa-block-question', 'base_url' => '{id}', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('socials')->insert($socials);
    }
}
