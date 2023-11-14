<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
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
            'address' => 'Dhaka',
            'contact_no' => '01711111111',
            'mail' => 'patthokrombd@gmail.com',
            'about_us' => 'Demo Content',
            'fb_link' => 'https://www.facebook.com/',
            'youtube_link' => 'https://www.youtube.com/',
        ],
        
        // Add more data as needed
    ];

    // Insert the data into the database
    DB::table('settings')->insert($data);

    }
}
