<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubcategoriasTable extends Migration
{

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('subcategorias', function(Blueprint $table)
            {
                  $table->increments('id');
                  $table->string('subcategoria');
                  $table->timestamps();
                  $table->integer('categoria_id')->unsigned();
                  $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade')->onUpdate('cascade');
            });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
            Schema::drop('subcategorias');
      }

}
