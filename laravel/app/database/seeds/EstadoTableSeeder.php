<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class EstadoTableSeeder extends Seeder
{

      public function run()
      {
            $faker = Faker::create();

            foreach (range(1, 100) as $index)
            {
                  Estado::create(array(
                      'estado' => $faker->word
                  ));
            }
      }

}
