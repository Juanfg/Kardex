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
            'code' => 'F1001',
            'name' => 'Introduccion a la fisica',
            'units' => 8,
            'semester_id' => 1
        ]);

        DB::table('courses')->insert([
            'code' => 'H1001',
            'name' => 'Ingles remedial I',
            'units' => 8,
            'semester_id' => 1
        ]);

        DB::table('courses')->insert([
            'code' => 'MA1001',
            'name' => 'Introduccion a las matematicas',
            'units' => 16,
            'semester_id' => 1
        ]);

        DB::table('courses')->insert([
            'code' => 'DS1003',
            'name' => 'Ciencias naturales y des suste',
            'units' => 8,
            'semester_id' => 2
        ]);

        DB::table('courses')->insert([
            'code' => 'H1002',
            'name' => 'Ingles remedial II',
            'units' => 8,
            'semester_id' => 1
        ]);

        DB::table('courses')->insert([
            'code' => 'TC1001',
            'name' => 'Introduccion a la computacion',
            'units' => 8,
            'semester_id' => 1
        ]);

        DB::table('courses')->insert([
            'code' => 'F1002',
            'name' => 'Fisica I',
            'units' => 8,
            'semester_id' => 2
        ]);

        DB::table('courses')->insert([
            'code' => 'H1015',
            'name' => 'Fundamentos de la escritura',
            'units' => 8,
            'semester_id' => 1
        ]);

        DB::table('courses')->insert([
            'code' => 'TC1021',
            'name' => 'Proyecto desarrollo de videoj',
            'units' => 8,
            'semester_id' => 5
        ]);
    }
}
