<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuariosRanks extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios_ranks', function(Blueprint $table)
		{
			$table->increments('id');
                  $table->integer('usuario_id')->unsigned();
                  $table->foreign('usuario_id')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');
			$table->string('rankable_type');
                  $table->integer('rankable_id');
                  $table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuarios_ranks');
	}

}
