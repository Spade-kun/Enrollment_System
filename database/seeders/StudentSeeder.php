<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        // Available courses
        $courses = ['BSIT', 'BSCS', 'BSCE', 'BSEd', 'BSBA'];

        // Create 50 students
        for ($i = 0; $i < 50; $i++) {
            // Create user first
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), // Default password
                'role' => 'student',
                'status' => 'added_as_student'
            ]);

            // Create corresponding student
            Student::create([
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'age' => $faker->numberBetween(17, 25),
                'year_level' => $faker->numberBetween(1, 4),
                'course' => $faker->randomElement($courses),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}