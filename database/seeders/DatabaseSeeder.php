<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Newbia Laravel',
            'email' => 'toi@gmail.com',
            'password' => Hash::make('55555555'),
        ]);
    }
}
