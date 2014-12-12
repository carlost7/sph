<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddImagenesFieldsToClientesnegociosimagenesTable extends Migration {

      /**
       * Make changes to the table.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('negocios_imagenes', function(Blueprint $table) {
                  $table->increments('id');
                  $table->string('imagen_file_name')->nullable();
                  $table->integer('imagen_file_size')->nullable();
                  $table->string('imagen_content_type')->nullable();
                  $table->timestamp('imagen_updated_at')->nullable();
                  $table->integer('negocio_id')->unsigned();
                  $table->foreign('negocio_id')->references('id')->on('negocios')->onDelete('cascade')->onUpdate('cascade');
                  $table->timestamps();
            });
      }

      /**
       * Revert the changes to the table.
       *
       * @return void
       */
      public function down()
      {
            Schema::drop('negocios_imagenes');
      }

}
