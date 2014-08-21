<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMasInfoTable extends Migration
{

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('mas_info_negocios', function(Blueprint $table)
            {
                  $table->increments('id');
                  $table->boolean('domicilio');
                  $table->boolean('llevar');
                  $table->string('moneda',3);
                  $table->decimal('rango_min');
                  $table->decimal('rango_max');
                  $table->boolean('efectivo');
                  $table->boolean('tc');
                  $table->boolean('td');
                  $table->boolean('familiar');
                  $table->boolean('alcohol');
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
            Schema::drop('mas_info_negocios');
      }

}
