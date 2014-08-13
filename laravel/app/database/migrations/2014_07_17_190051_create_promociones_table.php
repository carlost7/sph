<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePromocionesTable extends Migration
{

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('promociones', function(Blueprint $table)
            {
                  $table->increments('id');
                  $table->string('codigo');
                  $table->text('descripcion');
                  $table->datetime('vigencia_inicio');
                  $table->datetime('vigencia_fin');                  
                  $table->boolean('publicar');                  
                  $table->boolean('is_activo');
			$table->date('fecha_nueva_activacion');
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
            Schema::drop('promociones');
      }

}
