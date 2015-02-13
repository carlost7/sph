<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class EspecialNegocioTableSeeder extends Seeder {

      public function run()
      {
            $faker = Faker::create();

            foreach (range(1, 300) as $index) {
                  Negocio_especial::create(array(
                      "email"      => $faker->email,
                      "webpage"    => $faker->url,
                      "mapa"       => $faker->address,
                      "negocio_id" => $faker->unique()->numberBetween(1, 500),
                  ));
            }
      }

}
