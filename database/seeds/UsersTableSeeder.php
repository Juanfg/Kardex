<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Juan Pablo',
            'email' => 'juanfg@outlook.com',
            'password' => bcrypt('secret')
        ]);
    }
}
