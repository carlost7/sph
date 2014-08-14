<?php

class CostosTableSeeder extends Seeder
{

      public function run()
      {

            $costo = new Costo(array('tipo' => 'Negocio', 'precio' => '190.00'));
            $costo->save();
            $costo = new Costo(array('tipo' => 'Negocio', 'precio' => '190.00'));
            $costo->save();
            $costo = new Costo(array('tipo' => 'Negocio', 'precio' => '190.00'));
            $costo->save();
      }

}
