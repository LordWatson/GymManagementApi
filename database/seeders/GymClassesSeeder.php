<?php

namespace Database\Seeders;

use App\Models\GymClass;
use App\Models\User;
use App\Models\UserRole;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GymClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $frequencyArray = ['one off', 'weekly', 'bi weekly', 'monthly', 'daily'];

        // Get the ID of all Personal Trainers into an array to iterate over
        $personalTrainersArray = User::whereHas(
            'roles', function($q){
            $q->where('name', 'Personal Trainer');
        })
        ->pluck('id')
        ->toArray();

        foreach(range(1,20) as $i){
            $fakeDate = $faker->dateTimeBetween('-1 week', '+1 week');

            $gymClass = new GymClass();
            $gymClass->name = $faker->realText($faker->numberBetween(10, 20));
            $gymClass->description = $faker->realText($faker->numberBetween(20, 50));
            $gymClass->max_attendees = $faker->numberBetween(20, 50);
            $gymClass->start_date_time = $fakeDate;
            $gymClass->duration = 1;
            $gymClass->frequency = $frequencyArray[$faker->numberBetween(0, 4)];
            $gymClass->instructor_id = $personalTrainersArray[$faker->numberBetween(0, count($personalTrainersArray) - 1)];
            $gymClass->created_at = $fakeDate;
            $gymClass->updated_at = $fakeDate;
            $gymClass->save();
        }
    }
}
