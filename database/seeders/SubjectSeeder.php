<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
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
            'class_id' => '1',
            'sub_name' => 'Bangla',
            'sub_code' => '111',
            'sub_note' => 'Test',
        ],
        
        // Add more data as needed
    ];

    // Insert the data into the database
    DB::table('subjects')->insert($data);
    
    }
}
