<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddMasInfoNegociosTable extends Migration
{

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::table('mas_info_negocios', function(Blueprint $table)
            {
                  $table->boolean('estacionamiento');
                  $table->boolean('valet_parking');
                  $table->boolean('wifi');                  
                  $table->boolean('mascotas');                  
                  $table->dropColumn('domicilio');
                  $table->dropColumn('llevar');                  
                  $table->dropColumn('moneda');
                  $table->dropColumn('rango_min');
                  $table->dropColumn('rango_max');
                  $table->dropColumn('alcohol');
            });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
            Schema::table('mas_info_negocios', function(Blueprint $table)
            {
                  $table->dropColumn('estacionamiento');
                  $table->dropColumn('valet_parking');
                  $table->dropColumn('wifi');                  
                  $table->dropColumn('mascotas');                  
                  $table->boolean('domicilio');
                  $table->boolean('llevar');
                  $table->string('moneda');
                  $table->decimal('rango_min');
                  $table->decimal('rango_max');                                    
                  $table->boolean('alcohol');
            });
      }

}