<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class MarketingsTableSeeder extends Seeder
{

      public function run()
      {
            /* $faker = Faker::create();

              foreach (range(1, 5) as $index)
              {
              Marketing::create(array(
              'name' => $faker->name,
              'is_activo' => true,
              ));
              } */

            $marketing = Marketing::create(array(
                  'name' => 'Nestor Bernardino',
                  'is_activo' => true,
            ));
            /*User::create(array(
                  'password' => Hash::make('klendactu'),
                  'email' => 'nestor.bernardino@sphellar.com',
                  'userable_type' => 'Marketing',
                  'userable_id' => $marketing->id,
            ));*/
      }

}
