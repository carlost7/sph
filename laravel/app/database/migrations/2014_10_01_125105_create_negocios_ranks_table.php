<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNegociosRanksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('negocios_ranks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('miembro_id')->unsigned();
                  $table->foreign('miembro_id')->references('id')->on('miembros')->onDelete('cascade')->onUpdate('cascade');
			$table->integer('negocio_id')->unsigned();
                  $table->foreign('negocio_id')->references('id')->on('negocios')->onDelete('cascade')->onUpdate('cascade');
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
		Schema::drop('negocios_ranks');
	}

}
