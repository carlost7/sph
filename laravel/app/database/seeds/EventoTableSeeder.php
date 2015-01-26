<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class EventoTableSeeder extends Seeder
{

      public function run()
      {
            Eloquent::unguard();
            $faker = Faker::create();

            foreach (range(1, 1000) as $index)
            {
                  Evento::create(array(
                      "nombre" => $faker->company,
                      "fecha_inicio" => $faker->dateTime,
                      "fecha_fin" => $faker->dateTime,
                      "lugar" => $faker->name,
                      "direccion" => $faker->address,
                      "descripcion" => $faker->text(60),
                      "telefono" => $faker->phoneNumber,
                      "publicar" => true,
                      "is_especial" => true,
                      "cliente_id" => $faker->numberBetween(1, 100),
                      "hora_inicio" => $faker->dateTime,
                      "hora_fin" => $faker->dateTime,
                      "estado_id" => $faker->numberBetween(1, 32),
                      //"zona_id" => $faker->numberBetween(1, 200),
                      "categoria_id" => $faker->numberBetween(1, 15),
                      "is_activo" => true,
                      "fecha_nueva_activacion" => $faker->date($format = 'Y-m-d'),
                      "publicacion_inicio" => $faker->date($format = 'Y-m-d'),
                      "publicacion_fin" => $faker->date($format = 'Y-m-d'),
                      //"subcategoria_id" => $faker->numberBetween(1, 200)
                  ));
            }
      }

}
