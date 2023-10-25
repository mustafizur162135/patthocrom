<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questionTypes = [
            [
                'question_type_name' => 'Multiple Choice Single Answer',
                'question_type_code' => 'MSA',
            ],
            [
                'question_type_name' => 'Multiple Choice Multiple Answers',
                'question_type_code' => 'MMA',
            ],
            [
                'question_type_name' => 'True or False',
                'question_type_code' => 'TOF',
            ],
            [
                'question_type_name' => 'Short Answer',
                'question_type_code' => 'SAQ',
            ],
            [
                'question_type_name' => 'Match the Following',
                'question_type_code' => 'MTF',
            ],
            [
                'question_type_name' => 'Ordering/Sequence',
                'question_type_code' => 'ORD',
            ],
            [
                'question_type_name' => 'Fill in the Blanks',
                'question_type_code' => 'FIB',
            ],
            // Add more data as needed
        ];

        foreach ($questionTypes as $type) {
            DB::table('question_types')->insert($type);
        }
    }
}
