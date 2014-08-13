<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNegociosTable extends Migration
{

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('negocios', function(Blueprint $table)
            {
                  $table->increments('id');
                  $table->string('nombre');
                  $table->string('telefono');
                  $table->string('direccion');
                  $table->text('descripcion');
                  $table->string('moneda');
                  $table->string('rango_min');
                  $table->string('rango_max');
                  $table->double('likes')->default(0.0);
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
            Schema::drop('negocios');
      }

}



        