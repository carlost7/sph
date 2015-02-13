<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTopicToComentarios extends Migration {

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::table('comentarios', function(Blueprint $table) {
                  $table->text('topic_type')->nullable();
                  $table->integer('topic_id')->nullable();
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
                  $table->dropColumn('topic_type');
                  $table->dropColumn('topic_id');
            });
      }

}
