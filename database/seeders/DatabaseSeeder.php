<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // Create an account for me hehez
        \DB::table('users')->insert([
            'name' => 'John Michael Miguel',
            'email' => 'jmcm@gmail.com',
            'password' => Hash::make('password'),
            'birthdate' => '2000-06-05',
            'city' => 'Balanga',
            'contact_number' => '09399537899',
            'bio' => 'deez nuts'
        ]);

        User::factory(100)->hasPosts(10)->create();

    }
}
