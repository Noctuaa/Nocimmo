<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'slug' => 'Admin',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
