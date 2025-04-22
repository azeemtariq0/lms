<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Course; // Import the Course model

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert a dummy course
        $course = Course::create([
            'mollim_id' => 2, // You can change this to an existing mollim id
            'category_id' => 1, // You can change this to an existing category id
            'course_name' => 'Introduction to Programming',
            'slug' => 'introduction-to-programming',
            'course_name_ur' => 'پروگرامنگ کا تعارف',
            'image' => 'programming.jpg',
            'course_requirement' => 'Basic knowledge of computers',
            'course_detail' => 'This course introduces the fundamentals of programming, including basic syntax, variables, and control structures.',
            'path' => '',
            'duration' => '1 Hours, 49 Minutes',
            'status' => 1,
        ]);

        // Insert dummy data for course_attachments related to the above course
        DB::table('course_attachments')->insert([
            [
                'course_id' => $course->id, // Use the generated course id
                'path' => 'sample_guide.pdf',
                'type' => 'pdf',
                'filesize' => 2048,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => $course->id, // Use the generated course id
                'path' => 'sample_notes.docx',
                'type' => 'docx',
                'filesize' => 1024,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Insert dummy data for course_lectures related to the above course
        DB::table('course_lectures')->insert([
            [
                'course_id' => $course->id, // Use the generated course id
                'title' => 'Introduction to Programming',
                'description' => 'This lecture covers the basics of programming and introduces fundamental concepts.',
                'duration' => 60, // Duration in minutes
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => $course->id, // Use the generated course id
                'title' => 'Control Structures in Programming',
                'description' => 'This lecture introduces control structures like loops and conditional statements.',
                'duration' => 90, // Duration in minutes
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
