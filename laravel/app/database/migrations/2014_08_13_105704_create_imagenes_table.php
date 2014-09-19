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
                  $table->integer('user_id')->unsigned();
                  $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');                  
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
