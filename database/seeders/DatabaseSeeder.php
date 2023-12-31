<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UserSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(QuestionTypeSeeder::class);
        $this->call(QuestionDifLevel::class);
        $this->call(SettingSeeder::class);
        $this->call(ExamSeeder::class);
        // $this->call(StudentPackageSeeder::class);
    }
}
