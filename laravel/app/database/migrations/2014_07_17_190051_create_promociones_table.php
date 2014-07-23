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
                  $table->string('nombre');
                  $table->text('descripcion');
                  $table->datetime('inicio');
                  $table->datetime('fin');
                  $table->string('path');
                  $table->integer('client_id')->unsigned();
                  $table->boolean('publicar');
                  $table->boolean('is_especial');
                  $table->timestamps();
                  $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
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
