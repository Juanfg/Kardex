<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'code' => 'TH1',
            'name' => 'Matematicas I',
            'units' => 8,
            'semester_id' => 1
        ]);

        DB::table('courses')->insert([
            'code' => 'TH2',
            'name' => 'Matematicas II',
            'units' => 8,
            'semester_id' => 2
        ]);

        DB::table('courses')->insert([
            'code' => 'TH3',
            'name' => 'Matematicas III',
            'units' => 8,
            'semester_id' => 3
        ]);
    }
}
