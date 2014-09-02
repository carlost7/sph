<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class NegocioTableSeeder extends Seeder
{

      public function run()
      {
            Eloquent::unguard();
            $faker = Faker::create();

            foreach (range(1, 501) as $index)
            {
                  Negocio::create(array(
                      "nombre" => $faker->company,
                      "telefono" => $faker->phoneNumber,
                      "direccion" => $faker->address,
                      "descripcion" => $faker->text(200),
                      "publicar" => $faker->boolean(80),
                      "is_especial" => $faker->boolean(60),
                      "is_activo" => $faker->boolean(60),
                      "fecha_nueva_activacion" => $faker->dateTime,
                      "cliente_id" => $faker->numberBetween(1, 100),
                      "estado_id" => $faker->numberBetween(1, 2),
                      "zona_id" => $faker->numberBetween(1, 2),
                      "categoria_id" => $faker->numberBetween(1, 2),
                      "subcategoria_id" => $faker->numberBetween(1, 2)
                  ));

                  MasInfoNegocio::create(array(
                      "domicilio" => $faker->address,
                      "llevar" => $faker->boolean(),
                      "moneda" => "MXN",
                      "rango_min" => $faker->numberBetween(300, 1000),
                      "rango_max" => $faker->numberBetween(1000, 5000),
                      "efectivo" => $faker->boolean(),
                      "tc" => $faker->boolean(),
                      "td" => $faker->boolean(),
                      "familiar" => $faker->boolean(),
                      "alcohol" => $faker->boolean(),
                      "negocio_id" => $faker->unique()->numberBetween(1, 501)
                  ));

                  HorarioNegocio::create(array(
                      "lun_ini" => $faker->dateTime,
                      "lun_fin" => $faker->dateTime,
                      "mar_ini" => $faker->dateTime,
                      "mar_fin" => $faker->dateTime,
                      "mie_ini" => $faker->dateTime,
                      "mie_fin" => $faker->dateTime,
                      "jue_ini" => $faker->dateTime,
                      "jue_fin" => $faker->dateTime,
                      "vie_ini" => $faker->dateTime,
                      "vie_fin" => $faker->dateTime,
                      "sab_ini" => $faker->dateTime,
                      "sab_fin" => $faker->dateTime,
                      "dom_ini" => $faker->dateTime,
                      "dom_fin" => $faker->dateTime,
                      "negocio_id" => $faker->unique()->numberBetween(1, 501),
                  ));

                  Negocio_especial::create(array(
                      "email" => $faker->email,
                      "webpage" => $faker->url,
                      "mapa" => $faker->address,
                      "negocio_id" => $faker->unique()->numberBetween(1, 200),
                  ));
            }
      }

}
