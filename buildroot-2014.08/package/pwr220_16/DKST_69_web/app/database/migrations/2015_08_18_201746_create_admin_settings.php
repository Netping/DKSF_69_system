<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminSettings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin', function ($table) {
		  $table->increments('id');

		  $table->text("hostname");
		  $table->text("location");
		  $table->text("contacts");

		  $table->text("access_read");
		  $table->text("access_write");
		  $table->text("access_filter");

		  $table->text("timezone");

		  $table->text("datetime_offset");

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admin');
	}

}
