<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class ZonaTableSeeder extends Seeder {

      public function run()
      {
            $faker = Faker::create();

            foreach (range(1, 200) as $index) {
                  Zona::create(array(
                      'zona'      => $faker->word,
                      'estado_id' => $faker->numberBetween(1, 32),
                  ));
            }
      }

}
