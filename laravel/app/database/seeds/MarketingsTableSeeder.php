<?php

class MarketingsTableSeeder extends Seeder
{

      public function run()
      {

            $marketing1 = new Marketing();            
            $marketing1->name = 'nombre';
            $marketing1->is_activo = true;            
            $marketing1->save();
            
            $marketing2 = new Marketing();            
            $marketing2->name = 'nombre';
            $marketing2->is_activo = true;            
            $marketing2->save();
            
            
            $user1 = new User();
            $user1->password = Hash::make('klendactu');
            $user1->email = 'mkt1@sphellar.com';
            $user1->userable_id = $marketing1->id;
            $user1->userable_type = get_class($marketing1);
            $user1->save();
            
            $user2 = new User();
            $user2->password = Hash::make('klendactu');
            $user2->email = 'mkt2@sphellar.com';
            $user2->userable_id = $marketing2->id;
            $user2->userable_type = get_class($marketing2);
            $user2->save();
            
      }

}
