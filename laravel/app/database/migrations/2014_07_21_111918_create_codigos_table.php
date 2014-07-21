<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCodigosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('codigos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('numero');
			$table->boolean('usado');
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
		Schema::drop('codigos');
	}

}
