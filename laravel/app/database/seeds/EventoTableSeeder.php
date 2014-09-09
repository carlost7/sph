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
                      "publicar" => $faker->boolean(90),
                      "is_especial" => $faker->boolean(90),
                      "cliente_id" => $faker->numberBetween(1, 100),
                      "hora_inicio" => $faker->dateTime,
                      "hora_fin" => $faker->dateTime,
                      "estado_id" => $faker->numberBetween(1, 100),
                      "zona_id" => $faker->numberBetween(1, 500),
                      "categoria_id" => $faker->numberBetween(1, 100),
                      "subcategoria_id" => $faker->numberBetween(1, 500)
                  ));
            }
      }

}
