<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentPackageSeeder extends Seeder
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
            'exam_id' => '1',
            'studentpackage_name' => 'Free Package',
            'studentpackage_price' => '111',
        ],
        
        // Add more data as needed
    ];

    // Insert the data into the database
    DB::table('studentpackages')->insert($data);
    }
}
