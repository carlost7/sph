<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSpecialToNegocios extends Migration {

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::table('negocios', function(Blueprint $table) {
                  $table->text('email');
                  $table->text('webpage');
                  $table->double('lat');
                  $table->double('long');
            });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
            Schema::table('negocios', function(Blueprint $table) {
                  $table->dropColumn('email');
                  $table->dropColumn('webpage');
                  $table->dropColumn('lat');
                  $table->dropColumn('long');
            });
      }

}
