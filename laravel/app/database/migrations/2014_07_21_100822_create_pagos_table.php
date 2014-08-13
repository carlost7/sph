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
                  $table->string('pagable_type');
                  $table->integer('pagable_id');
			$table->timestamps();
                  $table->integer('cliente_id')->unsigned();                  
                  $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade')->onUpdate('cascade');
                  $table->string('status');
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
