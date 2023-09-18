<?php

namespace Database\Seeders;

use App\Models\Business;
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
        $positions = ['Back End', 'Front End', 'Design', 'Tester', 'Comtor IT', 'Tech Lead', 'Project Manager', 'Business Analyst'];
        $levels = ['Intern', 'Fresher', 'Junior', 'Middle', 'Senior'];
        $types = ['Full time', 'Part time', 'Remote'];
        $skills = [
            "ReactJS",
            "Angular",
            "Vue.js",
            "HTML",
            "CSS",
            "JavaScript",
            "TypeScript",
            "Java",
            "Python",
            "C++",
            "C#",
            "PHP",
            "Ruby",
            "Swift",
            "Kotlin",
            "Node.js",
            "Express.js",
            "Django",
            "Flask",
            "Ruby on Rails",
            "MySQL",
            "PostgreSQL",
            "MongoDB",
            "Firebase",
            "SQLite",
            "Git",
            "Docker",
            "Kubernetes",
            "AWS",
            "Azure",
            "Google Cloud",
            "RESTful API",
            "GraphQL",
            "Responsive Web Design",
            "UI/UX Design",
            "Agile Development",
            "Scrum",
            "DevOps",
            "Machine Learning",
            "Artificial Intelligence",
            "Data Science",
            "Cybersecurity",
            "Blockchain",
            "AR/VR Development",
            "Game Development",
            "Big Data",
            "Microservices",
            "Serverless Architecture",
            "Linux Administration",
        ];

        for ($i = 1; $i <= 50; $i++) {
            Job::create([
                'business_id' => Business::inRandomOrder()->value('id'),
                'position' => array_rand(array_flip($positions)),
                'level' => $faker->randomElements($levels, $faker->numberBetween(1, 2)),
                'type' => $faker->randomElements($types, $faker->numberBetween(1, 2)),
                'salary' => $faker->numberBetween(30000, 80000),
                'content' => $faker->paragraph,
                'requirement' => $faker->paragraph,
                'quantity' => $faker->numberBetween(1, 5),
                'skill' => $faker->randomElements($skills, $faker->numberBetween(1, 2)),
                'benefits' => $faker->sentence,
                'start_day' => $faker->dateTimeThisMonth('+1 week')->format('Y-m-d'),
                'end_day' => $faker->dateTimeThisMonth('+2 months')->format('Y-m-d'),
                'status' => $faker->boolean,
                'view_count' => $faker->numberBetween(0, 50),
            ]);
        }
    }
}
