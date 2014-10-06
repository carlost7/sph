<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventosRanksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('eventos_ranks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('miembro_id')->unsigned();
                  $table->foreign('miembro_id')->references('id')->on('miembros')->onDelete('cascade')->onUpdate('cascade');
			$table->integer('evento_id')->unsigned();
                  $table->foreign('evento_id')->references('id')->on('eventos')->onDelete('cascade')->onUpdate('cascade');
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
		Schema::drop('eventos_ranks');
	}

}
