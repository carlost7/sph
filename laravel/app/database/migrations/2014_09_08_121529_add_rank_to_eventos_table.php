<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRankToEventosTable extends Migration {

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::table('eventos', function(Blueprint $table) {
                  $table->double('rank')->default(0.0);
            });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
            Schema::table('eventos', function(Blueprint $table) {
                  $table->dropColumn('rank');
            });
      }

}
