<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventosEspecialesTable extends Migration
{

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('eventos_especiales', function(Blueprint $table)
            {
                  $table->increments('id');
                  $table->string('mapa');
                  $table->string('email');
                  $table->string('web');
                  $table->timestamps();
                  $table->integer('evento_id')->unsigned();
                  $table->foreign('evento_id')->references('id')->on('eventos')->onDelete('cascade')->onUpdate('cascade');
            });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
            Schema::drop('eventos_especiales');
      }

}
