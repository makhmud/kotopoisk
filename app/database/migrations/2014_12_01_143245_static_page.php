<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StaticPage extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('static_pages', function($table)
        {
            $table->increments('id');
            $table->string('key')->unique();
            $table->string('alias');
            $table->string('title')->nullable();
            $table->text('keywords')->nullable();
            $table->string('description')->nullable();
            $table->text('content')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('static_pages');
	}

}
