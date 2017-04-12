<?php

use Illuminate\Database\Seeder;

class CoursesStudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses_students')->insert([
            'course_id' => 1,
            'student_id' => 1,
            'grade' => 91,
            'approved' => true
        ]);

        DB::table('courses_students')->insert([
            'course_id' => 2,
            'student_id' => 2,
            'grade' => 71,
            'approved' => true
        ]);

        DB::table('courses_students')->insert([
            'course_id' => 2,
            'student_id' => 3,
            'grade' => 94,
            'approved' => true
        ]);

        DB::table('courses_students')->insert([
            'course_id' => 1,
            'student_id' => 4,
            'grade' => 85,
            'approved' => true
        ]);

        DB::table('courses_students')->insert([
            'course_id' => 3,
            'student_id' => 1,
            'grade' => 75,
            'approved' => true
        ]);
    }
}
