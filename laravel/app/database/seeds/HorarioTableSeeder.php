<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class HorarioTableSeeder extends Seeder
{

      public function run()
      {
            Eloquent::unguard();
            $faker = Faker::create();

            foreach (range(1, 1000) as $index)
            {
                  HorarioNegocio::create(array(
                      "lun_ini" => $faker->dateTime,
                      "lun_fin" => $faker->dateTime,
                      "mar_ini" => $faker->dateTime,
                      "mar_fin" => $faker->dateTime,
                      "mie_ini" => $faker->dateTime,
                      "mie_fin" => $faker->dateTime,
                      "jue_ini" => $faker->dateTime,
                      "jue_fin" => $faker->dateTime,
                      "vie_ini" => $faker->dateTime,
                      "vie_fin" => $faker->dateTime,
                      "sab_ini" => $faker->dateTime,
                      "sab_fin" => $faker->dateTime,
                      "dom_ini" => $faker->dateTime,
                      "dom_fin" => $faker->dateTime,
                      "negocio_id" => $faker->unique()->numberBetween(1, 1000),
                  ));                  
            }
      }

}
