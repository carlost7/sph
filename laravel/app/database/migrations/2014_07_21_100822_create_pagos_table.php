<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pagos', function(Blueprint $table)
		{
			$table->increments('id');
                  $table->string('nombre');
			$table->string('descripcion');
			$table->float('monto');
			$table->boolean('pagado');
                  $table->string('metodo');
                  $table->integer('client_id')->unsigned();
                  $table->integer('pagable_id');
                  $table->string('pagable_type');
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
		Schema::drop('pagos');
	}

}
