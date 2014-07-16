<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNegociosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('negocios', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre');
			$table->string('direccion');
			$table->string('telefono');
			$table->text('descripcion');
                  $table->boolean('publicar');
			$table->integer('client_id')->unsigned();
			$table->timestamps();
                  $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('negocios');
	}

}
