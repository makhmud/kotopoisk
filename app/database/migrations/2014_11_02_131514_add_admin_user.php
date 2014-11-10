<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdminUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::table('users')->insert(
            array(
                array('email' => 'admin@mail.ru', 'password'=>Hash::make('123123'), 'is_admin'=>true),
            ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::table('users')->delete(
            array(
                array('email' => 'admin@mail.ru', 'password'=>Hash::make('123123'), 'is_admin'=>true),
            ));
	}

}
