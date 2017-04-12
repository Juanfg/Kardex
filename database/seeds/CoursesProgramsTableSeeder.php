<?php

use Illuminate\Database\Seeder;

class CoursesProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses_programs')->insert([
            'course_id' => 1,
            'program_id' => 1
        ]);

        DB::table('courses_programs')->insert([
            'course_id' => 2,
            'program_id' => 1
        ]);

        DB::table('courses_programs')->insert([
            'course_id' => 3,
            'program_id' => 1
        ]);

        DB::table('courses_programs')->insert([
            'course_id' => 1,
            'program_id' => 2
        ]);

        DB::table('courses_programs')->insert([
            'course_id' => 2,
            'program_id' => 2
        ]);

        DB::table('courses_programs')->insert([
            'course_id' => 3,
            'program_id' => 2
        ]);

        DB::table('courses_programs')->insert([
            'course_id' => 1,
            'program_id' => 3
        ]);

        DB::table('courses_programs')->insert([
            'course_id' => 2,
            'program_id' => 3
        ]);

        DB::table('courses_programs')->insert([
            'course_id' => 1,
            'program_id' => 4
        ]);
    }
}
