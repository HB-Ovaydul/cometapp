<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Supper Admin
        admin::create([
            'name' => 'provider',
            'email' => 'provider@gmail.com',
            'cell' => '07510886524',
            'username' => 'provider',
            'password' => Hash::make('supper'),
        ]);
    }
}
