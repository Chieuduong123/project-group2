<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $names = [
            'business1', 'business2', 'business3', 'business4', 'business5',
            'business6', 'business7', 'business8', 'business9', 'business10'
        ];

        for ($i = 0; $i < count($names); $i++) {
            $name = $names[$i];
            $email = $name . '@gmail.com';
            $password = $name . '123';
            $phone = str_pad(mt_rand(1, 9999999999), 10, '0', STR_PAD_LEFT);
            $location = 'Đà Nẵng';
            $website = 'http://' . $name;
            $career = 20;
            $size = 35;
            $status = true;

            DB::table('businesses')->insert([
                'id' => $i + 1,
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
                'phone' => $phone,
                'location' => $location,
                'website' => $website,
                'career' => $career,
                'size' => $size,
                'status' => $status,
            ]);
        }
    }
}
