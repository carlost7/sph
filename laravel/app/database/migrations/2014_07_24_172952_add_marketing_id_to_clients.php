<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddMarketingIdToClients extends Migration {

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::table('clientes', function(Blueprint $table) {
                  $table->integer('marketing_id')->unsigned()->nullable();
                  $table->foreign('marketing_id')->references('id')->on('marketings')->onDelete('cascade')->onUpdate('cascade');
            });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
            Schema::table('clientes', function(Blueprint $table) {
                  $table->dropForeign('clientes_marketing_id_foreign');
                  $table->dropColumn('marketing_id');
            });
      }

}
