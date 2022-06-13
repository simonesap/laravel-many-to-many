<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => Str::random(10).'pippo',
        //     'email' => Str::random(10).'test@mail.com',
        //     'password' => Hash::make('password'),
        // ]);
        DB::table('users')->insert([
            'name' => 'pippo',
            'email' => 'test@mail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
