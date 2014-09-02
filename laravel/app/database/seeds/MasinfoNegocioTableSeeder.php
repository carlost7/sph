<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class MasinfoNegocioTableSeeder extends Seeder
{

      public function run()
      {
            Eloquent::unguard();
            $faker = Faker::create();

            foreach (range(1, 1000) as $index)
            {
                  MasInfoNegocio::create(array(
                      "domicilio" => $faker->boolean,
                      "llevar" => $faker->boolean(),
                      "moneda" => "MXN",
                      "rango_min" => $faker->numberBetween(300, 1000),
                      "rango_max" => $faker->numberBetween(1000, 5000),
                      "efectivo" => $faker->boolean(),
                      "tc" => $faker->boolean(),
                      "td" => $faker->boolean(),
                      "familiar" => $faker->boolean(),
                      "alcohol" => $faker->boolean(),
                      "negocio_id" => $faker->unique()->numberBetween(1, 1000)
                  ));

            }
      }

}
