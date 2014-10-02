<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class ClientesTableSeeder extends Seeder
{

      public function run()
      {
            $faker = Faker::create();

            foreach (range(1, 100) as $index)
            {
                  Cliente::create(array(
                      'nombre' => $faker->name,
                      'apellido' => $faker->name,
                      'empresa' => $faker->company,
                      'telefono' => $faker->phoneNumber,
                      'ext' => $faker->numberBetween(100, 990),
                      'celular' => $faker->phoneNumber,
                      'is_activo' => $faker->boolean(50),
                      'marketing_id' => 1,
                  ));
            }           
            
      }

}
