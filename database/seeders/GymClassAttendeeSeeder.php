<?php

namespace Database\Seeders;

use App\Models\GymClass;
use App\Models\GymClassAttendee;
use App\Models\User;
use App\Models\UserRole;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class GymClassAttendeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $gymClassesArray = GymClass::pluck('id')->toArray();

        // Get the ID of all Athletes into an array to iterate over
        $athletesArray = User::whereHas(
            'roles', function($q){
            $q->where('name', 'Athlete');
        })
        ->pluck('id')
        ->toArray();

        foreach(range(1,200) as $i){
            $fakeDate = $faker->dateTimeBetween('-1 week', '+1 week');

            $gymClassAttendee = new GymClassAttendee();
            $gymClassAttendee->gym_class_id = $gymClassesArray[$faker->numberBetween(0, count($gymClassesArray) - 1)];
            $gymClassAttendee->user_id = $athletesArray[$faker->numberBetween(0, count($athletesArray) - 1)];
            $gymClassAttendee->attended = $faker->boolean;
            $gymClassAttendee->created_at = date("Y-m-d H:i:s");
            $gymClassAttendee->updated_at = date("Y-m-d H:i:s");
            $gymClassAttendee->save();
        }
    }
}
