<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMasInfoEventosTable extends Migration {

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('mas_info_eventos', function(Blueprint $table) {
                  $table->increments('id');
                  $table->string('moneda');
                  $table->double('costo');
                  $table->integer('min_edad');
                  $table->integer('max_edad');
                  $table->boolean('alcohol');
                  $table->boolean('tc');
                  $table->boolean('td');
                  $table->boolean('efectivo');
                  $table->string('otra');
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
            Schema::drop('mas_info_eventos');
      }

}
