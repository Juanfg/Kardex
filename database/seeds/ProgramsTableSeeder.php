<?php

use Illuminate\Database\Seeder;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programs')->insert([
            'name' => 'ITC11'
        ]);
        
        DB::table('programs')->insert([
            'name' => 'IBT'
        ]);

        DB::table('programs')->insert([
            'name' => 'ISD'
        ]);

        DB::table('programs')->insert([
            'name' => 'IDS'
        ]);
    }
}
