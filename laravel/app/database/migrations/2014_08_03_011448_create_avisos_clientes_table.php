<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAvisosClientesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('avisos_clientes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('client_id')->unsigned();
			$table->string('avisable_type');
			$table->integer('avisable_id');
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
		Schema::drop('avisos_clientes');
	}

}
