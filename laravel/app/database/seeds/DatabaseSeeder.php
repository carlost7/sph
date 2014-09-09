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
            
            $this->call('UserTableSeeder');
            $this->call('MarketingsTableSeeder');
            $this->call('ClientesTableSeeder');            
            
            $this->call('CategoriaTableSeeder');
            $this->call('SubcategoriaTableSeeder');
            $this->call('EstadoTableSeeder');
            $this->call('ZonaTableSeeder');
            
            $this->call('NegocioTableSeeder');
            $this->call('MasinfoNegocioTableSeeder');
            $this->call('HorarioTableSeeder');
            $this->call('EspecialNegocioTableSeeder');
            
            $this->call('EventoTableSeeder');
            $this->call('MasinfoEventoTableSeeder');            
            $this->call('EspecialEventoTableSeeder');
            
            
      }

}
