<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
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
        $faker = Faker::create();

        foreach(range(1,20) as $i){
            $fakeDate = $faker->dateTimeBetween('-1 week', '+1 week');

            $user = new User();
            $user->name = $faker->name;
            $user->email = $faker->email;
            $user->password = Hash::make('password');
            $user->created_at = $fakeDate;
            $user->updated_at = $fakeDate;
            $user->save();

            $userRole = new UserRole();
            $userRole->user_id = $user->id;
            $userRole->role_id = 4;
            $userRole->created_at = date("Y-m-d H:i:s");
            $userRole->updated_at = date("Y-m-d H:i:s");
            $userRole->save();
        }
    }
}
