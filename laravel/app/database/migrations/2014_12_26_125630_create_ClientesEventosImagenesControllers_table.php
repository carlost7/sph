<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientesEventosImagenesControllersTable extends Migration {

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('eventos_imagenes', function(Blueprint $table) {
                  $table->increments('id');
                  $table->string('imagen_file_name')->nullable();
                  $table->integer('imagen_file_size')->nullable();
                  $table->string('imagen_content_type')->nullable();
                  $table->timestamp('imagen_updated_at')->nullable();
                  $table->integer('evento_id')->unsigned();
                  $table->foreign('evento_id')->references('id')->on('eventos')->onDelete('cascade')->onUpdate('cascade');
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
            Schema::drop('eventos_imagenes');
      }

}
