<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '123Password123!',
        ]);
    }
}
