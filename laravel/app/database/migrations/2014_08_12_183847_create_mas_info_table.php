<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMasInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mas_info', function(Blueprint $table)
		{
			$table->increments('id');			
			$table->boolean('domicilio');
			$table->boolean('llevar');
			$table->boolean('efectivo');
			$table->boolean('TC');
			$table->boolean('TD');
			$table->boolean('familiar');
			$table->boolean('alcohol');
			$table->timestamps();
                  $table->integer('negocio_id')->unsigned();
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
		Schema::drop('mas_info');
	}

}
