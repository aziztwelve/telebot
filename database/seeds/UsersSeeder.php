<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'aziz_vayn@um-tech.ru',
            'password' => bcrypt('123456'),
        ]);
        factory(\App\User::class,  1)->states('admin')->make();
    }
}
