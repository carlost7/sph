<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class CatalogoTableSeeder extends Seeder
{

      public function run()
      {
            Eloquent::unguard();
            $faker = Faker::create();

            foreach (range(1, 3) as $index)
            {
                  Estado::create(array(
                      'estado' => $faker->word
                  ));
            }

            foreach (range(1,3) as $index)
            {
                  Zona::create(array(
                      'zona' => $faker->word,
                      'estado_id' => $faker->unique()->numberBetween(1,4),
                          
                  ));
            }
            
            foreach (range(1, 3) as $index)
            {
                  Categoria::create(array(
                      'categoria' => $faker->word
                  ));
            }
            
            foreach (range(1, 3) as $index)
            {
                  Subcategoria::create(array(
                      'subcategoria' => $faker->word,
                      'categoria_id' => $faker->unique()->numberBetween(1,4),
                  ));
            }            
      }

}
