<?php

namespace Database\Seeders;

use App\Models\Favorite;
use App\Models\Job;
use App\Models\Seeker;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $job = Job::pluck('id')->toArray();
        $seeker = Seeker::pluck('id')->toArray();

        for ($i = 1; $i <= 50; $i++) {
            Favorite::create([
                'job_id' => $faker->randomElement($job),
                'seeker_id' => $faker->randomElement($seeker),

            ]);
        }
    }
}
