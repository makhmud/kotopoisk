<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocial extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('social', function($table)
        {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('uid');
        });
        DB::statement("ALTER TABLE `users` CHANGE COLUMN `email` `email` varchar(255) NULL;");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::statement("ALTER TABLE `users` CHANGE COLUMN `email` `email` varchar(255) NOT NULL;");
        Schema::drop('social');
	}

}
