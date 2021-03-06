<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientesTable extends Migration {

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('clientes', function(Blueprint $table) {
                  $table->increments('id');
                  $table->string('nombre');
                  $table->string('apellido');
                  $table->string('empresa');
                  $table->string('telefono');
                  $table->string('ext');
                  $table->string('celular');
                  $table->boolean('is_activo');
                  $table->string('token');
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
            Schema::drop('clientes');
      }

}
