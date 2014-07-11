<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

      /**
       * Run the migrations.
       *
       * @return void
       */
      public function up()
      {
            Schema::create('users', function(Blueprint $table) {
                  $table->increments('id');
                  $table->string('nombre');
                  $table->string('password');
                  $table->string('email');
                  $table->string('telefono');
                  $table->string('remember_token',100)->nullable();
                  $table->timestamps();                  
                  $table->integer('role_id');
                  $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
                  $table->boolean('is_activo');
            });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
            Schema::drop('users');
      }

}
