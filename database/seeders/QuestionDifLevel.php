<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionDifLevel extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diffLevels = [
            [
                'question_diff_level_name' => 'Very Easy',
                'question_diff_level_code' => 'VERYEASY',
            ],
            [
                'question_diff_level_name' => 'Easy',
                'question_diff_level_code' => 'EASY',
            ],
            [
                'question_diff_level_name' => 'Medium',
                'question_diff_level_code' => 'MEDIUM',
            ],
            [
                'question_diff_level_name' => 'High',
                'question_diff_level_code' => 'HIGH',
            ],
            [
                'question_diff_level_name' => 'Very High',
                'question_diff_level_code' => 'VERYHIGH',
            ],
            // Add more data as needed
        ];

        foreach ($diffLevels as $level) {
            DB::table('question_diff_levels')->insert($level);
        }

    }
}
