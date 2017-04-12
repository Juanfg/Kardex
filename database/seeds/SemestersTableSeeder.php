<?php

use Illuminate\Database\Seeder;

class SemestersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('semesters')->insert([
            'name' => '1ro'
        ]);

        DB::table('semesters')->insert([
            'name' => '2do'
        ]);

        DB::table('semesters')->insert([
            'name' => '3ro'
        ]);

        DB::table('semesters')->insert([
            'name' => '4to'
        ]);

        DB::table('semesters')->insert([
            'name' => '5to'
        ]);

        DB::table('semesters')->insert([
            'name' => '6to'
        ]);

        DB::table('semesters')->insert([
            'name' => '7mo'
        ]);

        DB::table('semesters')->insert([
            'name' => '8vo'
        ]);

        DB::table('semesters')->insert([
            'name' => '9no'
        ]);
    }
}
