<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class CategoriaTableSeeder extends Seeder
{

      public function run()
      {
            Categoria::create(array(
                  'categoria' => 'Antros'));
            Categoria::create(array(
                  'categoria' => 'Arte'));
            Categoria::create(array(
                  'categoria' => 'Automotriz'));
            Categoria::create(array(
                  'categoria' => 'Bares'));
            Categoria::create(array(
                  'categoria' => 'Belleza'));
            Categoria::create(array(
                  'categoria' => 'Cafeterías'));
            Categoria::create(array(
                  'categoria' => 'Casinos'));
            Categoria::create(array(
                  'categoria' => 'Centros Comerciales'));
            Categoria::create(array(
                  'categoria' => 'Clubes'));
            Categoria::create(array(
                  'categoria' => 'Hospedaje'));
            Categoria::create(array(
                  'categoria' => 'Inmobiliarias'));
            Categoria::create(array(
                  'categoria' => 'Librerías'));
            Categoria::create(array(
                  'categoria' => 'Mascotas'));
            Categoria::create(array(
                  'categoria' => 'Medicina'));
            Categoria::create(array(
                  'categoria' => 'Museos'));
            Categoria::create(array(
                  'categoria' => 'Postres'));
            Categoria::create(array(
                  'categoria' => 'Puestos Callejeros'));
            Categoria::create(array(
                  'categoria' => 'Restaurantes'));
            Categoria::create(array(
                  'categoria' => 'Salud'));
            Categoria::create(array(
                  'categoria' => 'Servicios'));
            Categoria::create(array(
                  'categoria' => 'Teatros'));
            Categoria::create(array(
                  'categoria' => 'Tiendas'));
            Categoria::create(array(
                  'categoria' => 'Viajes'));
            Categoria::create(array(
                  'categoria' => 'Electrónicos'));
            Categoria::create(array(
                  'categoria' => 'Casa y Jardín'));
      }

}
