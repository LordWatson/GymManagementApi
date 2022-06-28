<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1,4) as $i){
            $fakeDate = $faker->dateTimeBetween('-1 week', '+1 week');

            $adminUser = new User();
            $adminUser->name = $faker->name;
            $adminUser->email = $faker->email;
            $adminUser->password = Hash::make('password');
            $adminUser->created_at = $fakeDate;
            $adminUser->updated_at = $fakeDate;
            $adminUser->save();

            $adminRole = new UserRole();
            $adminRole->user_id = $adminUser->id;
            $adminRole->role_id = 1;
            $adminRole->created_at = date("Y-m-d H:i:s");
            $adminRole->updated_at = date("Y-m-d H:i:s");
            $adminRole->save();
        }
    }
}
