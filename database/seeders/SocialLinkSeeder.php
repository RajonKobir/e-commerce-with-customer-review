<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('social_links')->insert([
            [
                'slug' => 'facebook',
                'url' => ''
            ],
            [
                'slug' => 'twitter',
                'url' => ''
            ],
            [
                'slug' => 'instagram',
                'url' => ''
            ],
            [
                'slug' => 'linkedin',
                'url' => ''
            ],
            [
                'slug' => 'youtube',
                'url' => ''
            ],
            [
                'slug' => 'discord',
                'url' => ''
            ],
            [
                'slug' => 'github',
                'url' => ''
            ],
            [
                'slug' => 'google',
                'url' => ''
            ]

        ]);
    }
}
