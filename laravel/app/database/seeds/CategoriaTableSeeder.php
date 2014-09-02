<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class CategoriaTableSeeder extends Seeder
{

      public function run()
      {
            $faker = Faker::create();

            
            foreach (range(1, 100) as $index)
            {
                  Categoria::create(array(
                      'categoria' => $faker->word
                  ));
            }            

      }

}
