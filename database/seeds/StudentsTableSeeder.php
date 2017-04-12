<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'code' => 'A01328617',
            'name' => 'Juan Pablo Flores Galindo',
            'program_id' => 1,
            'semester_id' => 6
        ]);

        DB::table('students')->insert([
            'code' => 'A01322804',
            'name' => 'Eduardo Luna Gutierrez',
            'program_id' => 1,
            'semester_id' => 6
        ]);

        DB::table('students')->insert([
            'code' => 'A01325607',
            'name' => 'Estefania Pitol',
            'program_id' => 1,
            'semester_id' => 2
        ]);

        DB::table('students')->insert([
            'code' => 'A01320583',
            'name' => 'Fernanda Montano',
            'program_id' => 1,
            'semester_id' => 1
        ]);
    }
}
