<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;

class ClientesTableSeeder extends Seeder {

      public function run()
      {
            $faker = Faker::create();

            $marketing = Marketing::create(array(
                        'name'      => 'Nestor Bernardino',
                        'is_activo' => true,
            ));

            foreach (range(1, 100) as $index) {
                  $cliente = new Cliente(array(
                      'nombre'    => $faker->name,
                      'apellido'  => $faker->name,
                      'empresa'   => $faker->company,
                      'telefono'  => $faker->phoneNumber,
                      'ext'       => $faker->numberBetween(100, 990),
                      'celular'   => $faker->phoneNumber,
                      'is_activo' => $faker->boolean(50),
                  ));

                  $cliente->marketing()->associate($marketing);

                  $user = new User(array('password' => 'klendactu', 'password_confirmation' => 'klendactu', 'email' => $faker->email));
                  $cliente->save();
                  $cliente->user()->save($user);


                  foreach (range(1, 10) as $i) {
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
                        ));
                        $negocio->cliente()->associate($cliente);
                        $negocio->zona()->associate(Zona::first());
                        $negocio->estado()->associate(Zona::first()->estado);
                        $negocio->subcategoria()->associate(Subcategoria::first());
                        $negocio->categoria()->associate(Subcategoria::first()->categoria);
                        $negocio->save();

                        $masInfo = new MasInfoNegocio(array(
                            "tc"              => $faker->boolean(),
                            "td"              => $faker->boolean(),
                            "estacionamiento" => $faker->boolean(),
                            "valet"           => $faker->boolean(),
                            "envio_domicilio" => $faker->boolean(),
                            "wifi"            => $faker->boolean(),
                            "paqueteria"      => $faker->boolean(),
                            "mascotas"        => $faker->boolean(),
                            "barra_libre"     => $faker->boolean(),
                            "formal"          => $faker->boolean(),
                            "camara_perm"     => $faker->boolean(),
                            "restaurante"     => $faker->boolean(),
                            "solo_mujeres"    => $faker->boolean(),
                            "solo_hombres"    => $faker->boolean(),
                            "personalizado"   => $faker->boolean(),
                            "taller"          => $faker->boolean(),
                            "clases_extra"    => $faker->boolean(),
                            "informacion"     => $faker->boolean(),
                            "lavanderia"      => $faker->boolean(),
                            "gimnasio"        => $faker->boolean(),
                            "membresia"       => $faker->boolean(),
                            "cafeteria"       => $faker->boolean(),
                            "pension"         => $faker->boolean(),
                            "cambios"         => $faker->boolean(),
                            "devoluciones"    => $faker->boolean(),
                            "bicicleta"       => $faker->boolean(),
                            "alcohol"         => $faker->boolean(),
                            "familiar"        => $faker->boolean(),
                            "cita"            => $faker->boolean(),
                            "pagos_diferidos" => $faker->boolean(),
                            "facturacion"     => $faker->boolean(),
                            "mensajeria"      => $faker->boolean(),
                            "internacional"   => $faker->boolean(),
                        ));

                        $negocio->masInfo()->save($masInfo);


                        $horario = new HorarioNegocio(array(
                            "lun_ini" => $faker->time($format   = 'H:i:s', $max      = 'now'),
                            "lun_fin" => $faker->time($format   = 'H:i:s', $max      = 'now'),
                            "mar_ini" => $faker->time($format   = 'H:i:s', $max      = 'now'),
                            "mar_fin" => $faker->time($format   = 'H:i:s', $max      = 'now'),
                            "mie_ini" => $faker->time($format   = 'H:i:s', $max      = 'now'),
                            "mie_fin" => $faker->time($format   = 'H:i:s', $max      = 'now'),
                            "jue_ini" => $faker->time($format   = 'H:i:s', $max      = 'now'),
                            "jue_fin" => $faker->time($format   = 'H:i:s', $max      = 'now'),
                            "vie_ini" => $faker->time($format   = 'H:i:s', $max      = 'now'),
                            "vie_fin" => $faker->time($format   = 'H:i:s', $max      = 'now'),
                            "sab_ini" => $faker->time($format   = 'H:i:s', $max      = 'now'),
                            "sab_fin" => $faker->time($format   = 'H:i:s', $max      = 'now'),
                            "dom_ini" => $faker->time($format   = 'H:i:s', $max      = 'now'),
                            "dom_fin" => $faker->time($format   = 'H:i:s', $max      = 'now'),
                        ));

                        $negocio->horario()->save($horario);

                        foreach (range(1, 5) as $im) {
                              $imagen = new NegocioImagen(array(
                              ));
                              $imagen->negocio()->associate($negocio);
                              $imagen->save();
                        }
                  }

                  foreach (range(1, 10) as $i) {
                        $evento = new Evento(array(
                            "nombre"             => $faker->name,
                            "fecha_inicio"       => $faker->date($format              = 'Y-m-d', $max                 = 'now'),
                            "fecha_fin"          => $faker->date($format              = 'Y-m-d', $max                 = 'now'),
                            "lugar"              => $faker->address,
                            "direccion"          => $faker->address,
                            "descripcion"        => $faker->text(100),
                            "telefono"           => $faker->phoneNumber,
                            "publicar"           => true,
                            "is_especial"        => true,
                            "is_activo"          => true,
                            "hora_inicio"        => $faker->time($format              = 'H:i:s', $max                 = 'now'),
                            "hora_fin"           => $faker->time($format              = 'H:i:s', $max                 = 'now'),
                            "rank"               => $faker->numberBetween(1, 100),
                            "publicacion_inicio" => $faker->date($format              = 'Y-m-d', $max                 = 'now'),
                            "publicacion_fin"    => $faker->date($format              = 'Y-m-d', $max                 = 'now'),
                            "email"              => $faker->email,
                            "webpage"            => "http://" . $faker->domainName . ".com",
                            "lat"                => $faker->latitude,
                            "long"               => $faker->longitude,
                            "tiempo_publicacion" => $faker->numberBetween(0, 4),
                        ));
                        $evento->cliente()->associate($cliente);
                        $evento->zona()->associate(Zona::first());
                        $evento->estado()->associate(Zona::first()->estado);
                        $evento->subcategoria()->associate(Subcategoria::first());
                        $evento->categoria()->associate(Subcategoria::first()->categoria);
                        $evento->save();

                        $masInfo = new MasInfoEvento(array(
                            "moneda"   => "MXN",
                            "costo"    => $faker->randomNumber(),
                            "min_edad" => $faker->numberBetween(15, 100),
                            "max_edad" => $faker->numberBetween(15, 100),
                            "alcohol"  => $faker->boolean(),
                            "tc"       => $faker->boolean(),
                            "td"       => $faker->boolean(),
                            "efectivo" => $faker->boolean(),
                        ));

                        $evento->masInfo()->save($masInfo);

                        foreach (range(1, 5) as $im) {
                              $imagen = new EventoImagen(array(
                              ));
                              $imagen->evento()->associate($evento);
                              $imagen->save();
                        }
                  }
            }
      }

}
