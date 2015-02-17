<?php

class DatabaseSeeder extends Seeder {

      /**
       * Run the database seeds.
       *
       * @return void
       */
      public function run()
      {
            Eloquent::unguard();
            $this->call('AdministradoresTableSeeder');
            /*$this->call('CatalogoTableSeeder');
              /*$this->call('TableSeeder');
              /*
              /*$this->call('PruebasTableSeeder'); 
            $this->call('ClientesTableSeeder');*/
      }

}
