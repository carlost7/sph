<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRankToComentarios extends Migration {

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::table('comentarios', function(Blueprint $table) {
                  $table->double('rank')->nullable();
            });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
            Schema::table('comentarios', function(Blueprint $table) {
                  $table->dropColumn('rank');
            });
      }

}
