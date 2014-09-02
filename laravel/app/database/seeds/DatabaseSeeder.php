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
            //$this->call('ClientesTableSeeder');
            $this->call('CatalogoTableSeeder');
            $this->call('NegocioTableSeeder');
            
            //$this->call('AdministradoresTableSeeder');
      }

}
