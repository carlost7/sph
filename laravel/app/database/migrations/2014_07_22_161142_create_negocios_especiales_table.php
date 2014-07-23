<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNegociosEspecialesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('negocios_especiales', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('negocio_id')->unsigned();
			$table->string('horario');
			$table->timestamps();
                  $table->foreign('negocio_id')->references('id')->on('negocios')->onDelete('cascade')->onUpdate('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('negocios_especiales');
	}

}
