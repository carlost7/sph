<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class PromocionesTableSeeder extends Seeder {

      public function run()
      {
            $faker = Faker::create();

            $negocios = Negocio::all();

            foreach ($negocios as $negocio) {
                  $i         = rand(1, 2);                  
                  $promocion = new Promocion([                      
                      'nombre'             => $faker->name,
                      'codigo'             => $faker->domainName,
                      'descripcion'        => $faker->text(100),                      
                      'vigencia_inicio'    => $faker->date(),
                      'vigencia_fin'       => $faker->date(),
                      'publicar'           => true,
                      'imagen'             => ($i == 1) ? "http://sphellar.com/mx/wp-content/uploads/2014/11/desierto-de-liwa-nota.jpg" : "http://sphellar.com/mx/wp-content/uploads/2014/11/mexico-cenotes-cuzama.jpg",
                      'tiempo_publicacion' => $faker->numberBetween(1, 3),
                      'negocio_id'         => $negocio->id,
                  ]);
                  $promocion->is_activo = true;
                  $promocion->publicacion_inicio = $faker->date();
                  $promocion->publicacion_fin = $faker->date();
                  
                  $negocio->promociones()->save($promocion);                   
            }
      }

}
