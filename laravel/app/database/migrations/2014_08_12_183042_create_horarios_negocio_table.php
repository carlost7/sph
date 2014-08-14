<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHorariosNegocioTable extends Migration
{

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('horarios_negocio', function(Blueprint $table)
            {
                  $table->increments('id');
                  $table->time('lun_ini');
                  $table->time('lun_fin');
                  $table->time('mar_ini');
                  $table->time('mar_fin');
                  $table->time('mie_ini');
                  $table->time('mie_fin');
                  $table->time('jue_ini');
                  $table->time('jue_fin');
                  $table->time('vie_ini');
                  $table->time('vie_fin');
                  $table->time('sab_ini');
                  $table->time('sab_fin');
                  $table->time('dom_ini');
                  $table->time('dom_fin');
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
