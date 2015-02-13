<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class EspecialEventoTableSeeder extends Seeder {

      public function run()
      {
            $faker = Faker::create();

            foreach (range(1, 300) as $index) {
                  Evento_especial::create(array(
                      "email"     => $faker->email,
                      "web"       => $faker->url,
                      "mapa"      => $faker->address,
                      "evento_id" => $faker->unique()->numberBetween(1, 500),
                  ));
            }
      }

}
