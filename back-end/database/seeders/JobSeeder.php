<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 10; $i++) {
            Job::create([
                'business_id' => $i,
                'position' => $faker->jobTitle,
                'level' => ['Mid-level', 'Senior'],
                'type' => 'Full-time',
                'salary' => $faker->numberBetween(30000, 80000),
                'content' => $faker->paragraph,
                'requirement' => $faker->paragraph,
                'quantity' => $faker->numberBetween(1, 5),
                'skill' => $faker->words(2, true),
                'benefits' => $faker->sentence,
                'start_day' => $faker->dateTimeThisMonth('+1 week')->format('Y-m-d'),
                'end_day' => $faker->dateTimeThisMonth('+2 months')->format('Y-m-d'),
                'status' => $faker->boolean,
            ]);
        }
    }
}
