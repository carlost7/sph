<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class UsuariosTableSeeder extends Seeder
{

      public function run()
      {
            $faker = Faker::create();

            foreach (range(1, 5) as $index)
            {
                  Marketing::create(array(
                      
                  ));
                  
                  Users::create(array(
                      'password' => Hash::make($faker->word),
                      'email' => $faker->email,
                      'userable_id' => $faker->numberBetween(1,5),
                      'userable_type' => 'Marketing',
                  
                  ));
            }
            
            foreach (range(1, 100) as $index)
            {
                  Cliente::create(array(
                      'nombre' => $faker->name,
                      'apellido'=> $faker->name,
                      'empresa'=> $faker->company,
                      'telefono'=> $faker->phoneNumber,
                      'ext'=> $faker->numberBetween(100,990),
                      'celular'=> $faker->phoneNumber,
                      'is_active'=> $faker->boolean($chanceOfGettingTrue = 50),
                      'marketing_id'=> $faker->numberBetween(1,5),
                  ));
                  
                  Users::create(array(
                      'password' => Hash::make($faker->word),
                      'email' => $faker->email,
                      'userable_id' => $faker->numberBetween(1,100),
                      'userable_type' => 'Marketing',
                  ));
            }
            
            
      }

}
