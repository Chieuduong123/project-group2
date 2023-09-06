<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeekerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'seeker1', 'seeker2', 'seeker3', 'seeker4', 'seeker5',
            'seeker6', 'seeker7', 'seeker8', 'seeker9', 'seeker10'
        ];

        for ($i = 0; $i < count($names); $i++) {
            $name = $names[$i];
            $email = $name . '@gmail.com';
            $password = $name . '123';
            $phone = str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);

            DB::table('seekers')->insert([
                'id' => $i + 1,
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
                'phone' => $phone,
            ]);
        }
    }
}
