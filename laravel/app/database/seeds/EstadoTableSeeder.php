<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class EstadoTableSeeder extends Seeder
{

      public function run()
      {
            Estado::create(array(
                'estado' => 'Aguascalientes'));
            Estado::create(array(
                'estado' => 'Baja California'));
            Estado::create(array(
                'estado' => 'Baja California Sur'));
            Estado::create(array(
                'estado' => 'Campeche'));
            Estado::create(array(
                'estado' => 'Coahuila'));
            Estado::create(array(
                'estado' => 'Colima'));
            Estado::create(array(
                'estado' => 'Chiapas'));
            Estado::create(array(
                'estado' => 'Chihuahua'));
            Estado::create(array(
                'estado' => 'Distrito Federal'));
            Estado::create(array(
                'estado' => 'Durango'));
            Estado::create(array(
                'estado' => 'Guanajuato'));
            Estado::create(array(
                'estado' => 'Guerrero'));
            Estado::create(array(
                'estado' => 'Hidalgo'));
            Estado::create(array(
                'estado' => 'Jalisco'));
            Estado::create(array(
                'estado' => 'Estado de México'));
            Estado::create(array(
                'estado' => 'Michoacán'));
            Estado::create(array(
                'estado' => 'Morelos'));
            Estado::create(array(
                'estado' => 'Nayarit'));
            Estado::create(array(
                'estado' => 'Nuevo León'));
            Estado::create(array(
                'estado' => 'Oaxaca'));
            Estado::create(array(
                'estado' => 'Puebla'));
            Estado::create(array(
                'estado' => 'Querétaro'));
            Estado::create(array(
                'estado' => 'Quintana Roo'));
            Estado::create(array(
                'estado' => 'San Luis Potosí'));
            Estado::create(array(
                'estado' => 'Sinaloa'));
            Estado::create(array(
                'estado' => 'Sonora'));
            Estado::create(array(
                'estado' => 'Tabasco'));
            Estado::create(array(
                'estado' => 'Tamaulipas'));
            Estado::create(array(
                'estado' => 'Tlaxcala'));
            Estado::create(array(
                'estado' => 'Veracruz'));
            Estado::create(array(
                'estado' => 'Yucatán'));
            Estado::create(array(
                'estado' => 'Zacatecas'));
      }

}
