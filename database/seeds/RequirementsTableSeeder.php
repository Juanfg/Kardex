<?php

use Illuminate\Database\Seeder;

class RequirementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('requirements')->insert([
            'course_id' => 3,
            'course_needed' => 1
        ]);

        DB::table('requirements')->insert([
            'course_id' => 3,
            'course_needed' => 2
        ]);

        DB::table('requirements')->insert([
            'course_id' => 2,
            'course_needed' => 1
        ]);
    }
}
