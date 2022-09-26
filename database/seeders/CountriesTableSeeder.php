<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Countries;
use App\Models\Fmatch;
use App\Models\Guessing;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Countries::truncate();
        $countries =  [
            [
                'name' => 'Qatar',
                'group' => 'A',
                'flag_image' => '',
            ],
            [
                'name' => 'Ecuador',
                'group' => 'A',
                'flag_image' => '',
            ],
            [
                'name' => 'Senegal',
                'group' => 'A',
                'flag_image' => '',
            ],
            [
                'name' => 'Netherlands',
                'group' => 'A',
                'flag_image' => '',
            ],
            [
                'name' => 'England',
                'group' => 'B',
                'flag_image' => '',
            ],
            [
                'name' => 'IR Iran',
                'group' => 'B',
                'flag_image' => '',
            ],
            [
                'name' => 'USA',
                'group' => 'B',
                'flag_image' => '',
            ],
            [
                'name' => 'Wales',
                'group' => 'B',
                'flag_image' => '',
            ],
            [
                'name' => 'Argentina',
                'group' => 'C',
                'flag_image' => '',
            ],
            [
                'name' => 'Saudi Arabia',
                'group' => 'C',
                'flag_image' => '',
            ],
            [
                'name' => 'Mexico',
                'group' => 'C',
                'flag_image' => '',
            ],
            [
                'name' => 'Poland',
                'group' => 'C',
                'flag_image' => '',
            ],
            [
                'name' => 'France',
                'group' => 'D',
                'flag_image' => '',
            ],
            [
                'name' => 'Australia',
                'group' => 'D',
                'flag_image' => '',
            ],
            [
                'name' => 'Denmark',
                'group' => 'D',
                'flag_image' => '',
            ],
            [
                'name' => 'Tunisia',
                'group' => 'D',
                'flag_image' => '',
            ],
            [
                'name' => 'Spain',
                'group' => 'E',
                'flag_image' => '',
            ],
            [
                'name' => 'Costa Rica',
                'group' => 'E',
                'flag_image' => '',
            ],
            [
                'name' => 'Germany',
                'group' => 'E',
                'flag_image' => '',
            ],
            [
                'name' => 'Japan',
                'group' => 'E',
                'flag_image' => '',
            ],
            [
                'name' => 'Belgium',
                'group' => 'F',
                'flag_image' => '',
            ],
            [
                'name' => 'Canada',
                'group' => 'F',
                'flag_image' => '',
            ],
            [
                'name' => 'Morocco',
                'group' => 'F',
                'flag_image' => '',
            ],
            [
                'name' => 'Croatia',
                'group' => 'F',
                'flag_image' => '',
            ],
            [
                'name' => 'Brazil',
                'group' => 'G',
                'flag_image' => '',
            ],
            [
                'name' => 'Serbia',
                'group' => 'G',
                'flag_image' => '',
            ],
            [
                'name' => 'Switzerland',
                'group' => 'G',
                'flag_image' => '',
            ],
            [
                'name' => 'Cameroon',
                'group' => 'G',
                'flag_image' => '',
            ],
            [
                'name' => 'Portugal',
                'group' => 'H',
                'flag_image' => '',
            ],
            [
                'name' => 'Ghana',
                'group' => 'H',
                'flag_image' => '',
            ],
            [
                'name' => 'Uruguay',
                'group' => 'H',
                'flag_image' => '',
            ],
            [
                'name' => 'Korea Republic',
                'group' => 'H',
                'flag_image' => '',
            ],
        ];

        Countries::insert($countries);

        Fmatch::truncate();

        $round = ['Group Stage 1', 'Group Stage 2', 'Group Stage 3', 'Round of 16', 'Quarter-finals', 'Semi-finals', 'Third place play-off', 'Final'];
        $matchday = ['Group Stage 1', 'Group Stage 2', 'Group Stage 3'];

        for ($i=0; $i < 10; $i++) { 
            Fmatch::create([
	            'id_team_a' => rand(1,32),
	            'id_team_b' => rand(1,32),
	            'score_a' => rand(0,5),
	            'score_b' => rand(0,5),
                'round' => $matchday[rand(0,2)],
                // 'expired_time' => '',
                // 'match_time' => ''
	        ]);
        }

        Guessing::truncate();
        for ($i=0; $i < 10; $i++) { 
            Guessing::create([
	            'id_user' => rand(1,10),
	            'id_match' => rand(1,10),
	            'guessing_score_a' => rand(0,5),
	            'guessing_score_b' => rand(0,5),
	        ]);
        }
    }
}
