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
            $this->call('MarketingsTableSeeder');
            $this->call('AdministradoresTableSeeder');
            $this->call('ClientesTableSeeder');
      }

}
