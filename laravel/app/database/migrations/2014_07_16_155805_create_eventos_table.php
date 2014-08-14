<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventosTable extends Migration
{

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('eventos', function(Blueprint $table)
            {
                  $table->increments('id');
                  $table->string('nombre');
                  $table->datetime('fecha_inicio');
                  $table->datetime('fecha_fin');
                  $table->string('horario');
                  $table->string('lugar');
                  $table->string('direccion');
                  $table->text('descripcion');
                  $table->string('telefono');                  
                  $table->boolean('publicar');
                  $table->boolean('is_especial');
                  $table->boolean('is_activo');
                  $table->date('fecha_nueva_activacion');
                  $table->integer('cliente_id')->unsigned();
                  $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');
                  $table->timestamps();
            });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
            Schema::drop('eventos');
      }

}
