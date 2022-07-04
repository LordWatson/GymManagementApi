<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            //\App\Models\User::factory(20)->create(),
            UserSeeder::class,
            AdminUserSeeder::class,
            RoleSeeder::class,
            GymClassesSeeder::class,
            PersonalTrainerSeeder::class,
            GymClassAttendeeSeeder::class,
        ]);
    }
}
