<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagenesTable extends Migration
{

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('imagenes', function(Blueprint $table)
            {
                  $table->increments('id');
                  $table->string('path');
                  $table->string('nombre');
                  $table->string('imageable_type');
                  $table->integer('imageable_id');
                  $table->string('alt');
                  $table->timestamps();
                  $table->integer('cliente_id')->unsigned();
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
            Schema::drop('imagenes');
      }

}
