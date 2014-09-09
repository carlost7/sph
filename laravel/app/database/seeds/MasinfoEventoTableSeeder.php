<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class MasinfoEventoTableSeeder extends Seeder
{

      public function run()
      {
            Eloquent::unguard();
            $faker = Faker::create();

            foreach (range(1, 1000) as $index)
            {
                  MasInfoEvento::create(array(
                      "moneda" => 'MEX',
                      "costo" => $faker->numberBetween(500, 1000),
                      "min_edad" => $faker->numberBetween(0, 10),
                      "max_edad" => $faker->numberBetween(10, 99),
                      "alcohol" => $faker->boolean(80),
                      "tc" => $faker->boolean(80),
                      "td" => $faker->boolean(80),
                      "efectivo" => $faker->boolean(80),
                      "otra" => '',
                      "evento_id" => $faker->numberBetween(1, 1000),
                  ));
            }
      }

}
