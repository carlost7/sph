<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBitacorasTable extends Migration {

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('bitacora_clientes', function(Blueprint $table) {
                  $table->increments('id');
                  $table->integer('cliente_id')->unsigned();
                  $table->datetime('fecha');
                  $table->string('mensaje');
                  $table->timestamps();
                  $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');
            });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
            Schema::drop('bitacora_clientes');
      }

}
