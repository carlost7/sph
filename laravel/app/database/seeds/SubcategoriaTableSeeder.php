<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class SubcategoriaTableSeeder extends Seeder
{

      public function run()
      {
            $faker = Faker::create();

            foreach (range(1, 500) as $index)
            {
                  Subcategoria::create(array(
                      'subcategoria' => $faker->word,
                      'categoria_id' => $faker->numberBetween(1,100),
                  ));
            }
      }

}
