<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class MasinfoNegocioTableSeeder extends Seeder {

      public function run()
      {
            Eloquent::unguard();
            $faker = Faker::create();

            foreach (range(1, 1000) as $index) {
                  MasInfoNegocio::create(array(
                      "efectivo"        => $faker->boolean(),
                      "tc"              => $faker->boolean(),
                      "td"              => $faker->boolean(),
                      "familiar"        => $faker->boolean(),
                      "estacionamiento" => $faker->boolean(),
                      "valet_parking"   => $faker->boolean(),
                      "wifi"            => $faker->boolean(),
                      "mascotas"        => $faker->boolean(),
                      "negocio_id"      => $faker->unique()->numberBetween(1, 1000)
                  ));
            }
      }

}
