<?php

use Illuminate\Database\Seeder;

use App\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $user = new User;
            if($i == 0)
            {
                $user->username = 'admin';
                $user->first_name = 'admin_fn';
                $user->last_name = 'admin_ln';
                $user->email = 'admin@gmail.com';
                $user->password = bcrypt('12345678');
                $user->role = 'admin';
            }
            else {
                $user->username = $faker->userName;
                $user->first_name = $faker->firstName;
                $user->last_name = $faker->lastName;
                $user->email = $faker->unique()->email;
                $user->password = bcrypt('12345678');
            }
            $user->save();
        }
    }
}
