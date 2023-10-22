<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
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
            'class_name' => 'BCS',
            'class_code' => '111',
            'class_note' => 'Test',
        ],
        
        // Add more data as needed
    ];

    // Insert the data into the database
    DB::table('classnames')->insert($data);

    }
}
