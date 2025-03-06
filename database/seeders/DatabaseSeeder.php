<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       DB::table('users')->insert([
            'name' => 'Adminlama',
            'email' => 'adminlamasekali@gmail.com',
            'password' => bcrypt('jawabarat'),
            'role' => 'admin',
        ]);
        
    }
}
