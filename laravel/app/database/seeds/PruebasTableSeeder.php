<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class PruebasTableSeeder extends Seeder {

      public function run()
      {
            $faker = Faker::create();

            $negocio = new Negocio(array(
                "nombre"      => $faker->name,
                "telefono"    => $faker->phoneNumber,
                "direccion"   => $faker->address,
                "descripcion" => $faker->text(100),
                "rank"        => $faker->numberBetween(1, 100),
                "publicar"    => true,
                "is_especial" => true,
                "is_activo"   => true,
                "email"       => $faker->email,
                "webpage"     => "http://" . $faker->domainName . ".com",
                "lat"         => $faker->latitude,
                "long"        => $faker->longitude,
                "imagen"      => "http://sphellar.com/mx/wp-content/uploads/2014/11/desierto-de-liwa-nota.jpg"
            ));
            $negocio->cliente()->associate(Cliente::first());
            $negocio->zona()->associate(Zona::first());
            $negocio->estado()->associate(Zona::first()->estado);
            $negocio->subcategoria()->associate(Subcategoria::first());
            $negocio->categoria()->associate(Subcategoria::first()->categoria);
            $negocio->save();
      }

}
