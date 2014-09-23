<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddBuscadorToEventos extends Migration
{

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::table('eventos', function(Blueprint $table)
            {
                  $table->integer('estado_id')->unsigned();
                  $table->integer('zona_id')->unsigned()->nullable();;
                  $table->integer('categoria_id')->unsigned();
                  $table->integer('subcategoria_id')->unsigned()->nullable();;

                  $table->foreign('estado_id')->references('id')->on('estados')->onDelete('cascade')->onUpdate('cascade');
                  $table->foreign('zona_id')->references('id')->on('zonas')->onDelete('cascade')->onUpdate('cascade');
                  $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade')->onUpdate('cascade');
                  $table->foreign('subcategoria_id')->references('id')->on('subcategorias')->onDelete('cascade')->onUpdate('cascade');
            });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
            Schema::table('eventos', function(Blueprint $table)
            {
                  $table->dropForeign('eventos_estado_id_foreign');
                  $table->dropForeign('eventos_zona_id_foreign');
                  $table->dropForeign('eventos_categoria_id_foreign');
                  $table->dropForeign('eventos_subcategoria_id_foreign');
                  $table->dropColumn('estado_id');
                  $table->dropColumn('zona_id');
                  $table->dropColumn('categoria_id');
                  $table->dropColumn('subcategoria_id');
            });
      }

}
