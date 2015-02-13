<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class NegocioTableSeeder extends Seeder {

      public function run()
      {
            Eloquent::unguard();
            $faker = Faker::create();

            foreach (range(1, 1000) as $index) {
                  Negocio::create(array(
                      "nombre"                 => $faker->company,
                      "telefono"               => $faker->phoneNumber,
                      "direccion"              => $faker->address,
                      "descripcion"            => $faker->text(200),
                      "publicar"               => true,
                      "is_especial"            => true,
                      "is_activo"              => true,
                      "fecha_nueva_activacion" => $faker->dateTime,
                      "cliente_id"             => $faker->numberBetween(1, 100),
                      "estado_id"              => $faker->numberBetween(1, 32),
                      //"zona_id" => $faker->numberBetween(1, 200),
                      "categoria_id"           => $faker->numberBetween(1, 15),
                          //"subcategoria_id" => $faker->numberBetween(1, 200)
                  ));
            }
      }

}
