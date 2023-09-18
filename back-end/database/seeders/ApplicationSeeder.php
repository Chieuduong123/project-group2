<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\Job;
use App\Models\Seeker;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $job = Job::pluck('id')->toArray();
        $seeker = Seeker::pluck('id')->toArray();
        $resume_path = [
            '1694404468.pdf',
            '1694404469.pdf',
            '1694404470.pdf',
        ];

        for ($i = 1; $i <= 30; $i++) {
            Application::create([
                'job_id' => $faker->randomElement($job),
                'seeker_id' => $faker->randomElement($seeker),
                'resume_path' => array_rand(array_flip($resume_path)),
                'name' => $faker->name,
                'phone' => str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT),
                'cover_letter' => $faker->paragraph,
            ]);
        }
    }
}
