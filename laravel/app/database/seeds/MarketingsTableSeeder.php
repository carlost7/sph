<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class MarketingsTableSeeder extends Seeder
{

      public function run()
      {
            $marketing = Marketing::create(array(
                  'name' => 'Nestor Bernardino',
                  'is_activo' => true,
            ));            
      }

}
