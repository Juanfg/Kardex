<?php

use Illuminate\Database\Seeder;

class ProgramsUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programs_users')->insert([
            'program_id' => 1,
            'user_id' => 1
        ]);
    }
}
