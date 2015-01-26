<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMasInfoTable extends Migration {

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('mas_info_negocios', function(Blueprint $table) {
                  $table->increments('id');
                  $table->boolean("tc");
                  $table->boolean("td");
                  $table->boolean("estacionamiento");
                  $table->boolean("valet");
                  $table->boolean("envio_domicilio");
                  $table->boolean("wifi");
                  $table->boolean("paqueteria");
                  $table->boolean("mascotas");
                  $table->boolean("barra_libre");
                  $table->boolean("formal");
                  $table->boolean("camara_perm");
                  $table->boolean("restaurante");
                  $table->boolean("solo_mujeres");
                  $table->boolean("solo_hombres");
                  $table->boolean("personalizado");
                  $table->boolean("taller");
                  $table->boolean("clases_extra");
                  $table->boolean("informacion");
                  $table->boolean("lavanderia");
                  $table->boolean("gimnasio");
                  $table->boolean("membresia");
                  $table->boolean("cafeteria");
                  $table->boolean("pension");
                  $table->boolean("cambios");
                  $table->boolean("devoluciones");
                  $table->boolean("bicicleta");
                  $table->boolean("alcohol");
                  $table->boolean("familiar");
                  $table->boolean("cita");
                  $table->boolean("pagos_diferidos");
                  $table->boolean("facturacion");
                  $table->boolean("mensajeria");
                  $table->boolean("internacional");
                  $table->timestamps();
                  $table->integer('negocio_id')->unsigned();
                  $table->foreign('negocio_id')->references('id')->on('negocios')->onDelete('cascade')->onUpdate('cascade');
            });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
            Schema::drop('mas_info_negocios');
      }

}
