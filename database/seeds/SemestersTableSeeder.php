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
            'name' => 'Remedial'
        ]);

        DB::table('semesters')->insert([
            'name' => '01'
        ]);

        DB::table('semesters')->insert([
            'name' => '02'
        ]);

        DB::table('semesters')->insert([
            'name' => '03'
        ]);

        DB::table('semesters')->insert([
            'name' => '04'
        ]);

        DB::table('semesters')->insert([
            'name' => '05'
        ]);

        DB::table('semesters')->insert([
            'name' => '06'
        ]);

        DB::table('semesters')->insert([
            'name' => '07'
        ]);

        DB::table('semesters')->insert([
            'name' => '08'
        ]);

        DB::table('semesters')->insert([
            'name' => '09'
        ]);
    }
}
