<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTachesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('taches', function(Blueprint $table)
		{
			$table->increments('id')->unique();
			$table->string('liste');
			$table->integer('user_id');
			$table->string('tache');
			$table->boolean('done');
			$table->date('date');
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
		Schema::drop('taches');
	}

}
