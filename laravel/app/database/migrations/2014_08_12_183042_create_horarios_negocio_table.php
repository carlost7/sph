<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHorariosNegocioTable extends Migration {

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('horarios_negocio', function(Blueprint $table) {
                  $table->increments('id');
                  $table->time('lun_ini')->nullable();
                  $table->time('lun_fin')->nullable();
                  $table->time('mar_ini')->nullable();
                  $table->time('mar_fin')->nullable();
                  $table->time('mie_ini')->nullable();
                  $table->time('mie_fin')->nullable();
                  $table->time('jue_ini')->nullable();
                  $table->time('jue_fin')->nullable();
                  $table->time('vie_ini')->nullable();
                  $table->time('vie_fin')->nullable();
                  $table->time('sab_ini')->nullable();
                  $table->time('sab_fin')->nullable();
                  $table->time('dom_ini')->nullable();
                  $table->time('dom_fin')->nullable();
                  $table->timestamps();
                  $table->integer('negocio_id')->unsigned();
                  $table->foreign('negocio_id')->references('id')->on('negocios')->onDelete('cascade')->onUpdate('cascade');
            });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
            Schema::drop('horarios_negocio');
      }

}
