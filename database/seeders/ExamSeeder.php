<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Define the data you want to seed here
       $data = [
        [
            'exam_name' => 'BCS Primary Model Test',
            'exam_code' => '111',
            'exam_desc' => 'BCS Exam',
            'class_code' => '111',
            'sub_code' => '111',
            'total_qc' => '40',
        ],
        
        // Add more data as needed
    ];

    // Insert the data into the database
    DB::table('exams')->insert($data);
    }
}
