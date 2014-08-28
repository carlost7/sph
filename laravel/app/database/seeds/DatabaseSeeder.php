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
            $this->call('MarketingsTableSeeder1');
            $this->call('AdministradoresTableSeeder1');
            $this->call('ClientesTableSeeder1');
      }

}
