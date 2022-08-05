<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()
        ->count(3)
        ->state(new Sequence(
            [
                'username' => 'adminA',
                'password' => Hash::make('A12345'),
                'search_province' => 1,
                'search_city' => 1,
            ],
            [
                'username' => 'adminB',
                'password' => Hash::make('B12345'),
                'search_province' => 1,
            ],
            [
                'username' => 'adminC',
                'password' => Hash::make('C12345'),
                'search_city' => 1,
            ],
        ))
        ->create();
    }
}
