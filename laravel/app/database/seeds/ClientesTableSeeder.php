<?php

class ClientesTableSeeder extends Seeder
{

      public function run()
      {
            $cliente1 = new Cliente();
            $cliente1->nombre = 'nombre';
            $cliente1->apellido = 'apellido';
            $cliente1->empresa = 'empresa';
            $cliente1->telefono = '5464645464';
            $cliente1->ext = '123';
            $cliente1->celular = '5464645647864';
            $cliente1->is_active = true;            
            $cliente1->marketing_id = Marketing::get()->first()->id;
            $cliente1->save();

            $user1 = new User();
            $user1->password = Hash::make('klendactu');
            $user1->email = 'cliente@sphellar.com';
            $user1->userable_id = $cliente1->id;
            $user1->userable_type = get_class($cliente1);
            $user1->save();

            
      }

}
