<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{

      public function run()
      {
            $faker = Faker::create();

            foreach (range(1, 105) as $index)
            {
                  User::create(array(
                      'password' => Hash::make('klendactu'),
                      'email' => $faker->email,                      
                  ));
            }           
            
      }

}
