<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DeleteHorarioFromEventos extends Migration {

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::table('eventos', function($table) {
                  $table->dropColumn('horario');
                  $table->time('hora_inicio');
                  $table->time('hora_fin');
            });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
            Schema::table('eventos', function($table) {
                  $table->dropColumn('hora_inicio');
                  $table->dropColumn('hora_fin');
                  $table->string('horario');
            });
      }

}
