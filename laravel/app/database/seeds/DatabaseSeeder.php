<?php

class DatabaseSeeder extends Seeder
{

      /**
       * Run the database seeds.
       *
       * @return void
       */
      public function run()
      {
            Eloquent::unguard();
            $this->call('AdministradoresTableSeeder');
            $this->call('MarketingsTableSeeder');
            $this->call('CatalogoTableSeeder');
            /*$this->call('UserTableSeeder');            */
            /*$this->call('ClientesTableSeeder');*/
            
      }

}
