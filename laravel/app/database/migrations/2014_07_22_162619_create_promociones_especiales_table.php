<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePromocionesEspecialesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('promociones_especiales', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('promocion_id')->unsigned();
			$table->string('imagenes');
			$table->timestamps();
                  $table->foreign('promocion_id')->references('id')->on('promociones')->onDelete('cascade')->onUpdate('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('promociones_especiales');
	}

}
