<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTimpoPublicactionToPromociones extends Migration {

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::table('promociones', function(Blueprint $table) {
                  $table->integer('tiempo_publicacion')->nullable();
            });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
            Schema::table('promociones', function(Blueprint $table) {
                  $table->dropColumn('tiempo_publicacion');
            });
      }

}
