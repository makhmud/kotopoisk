<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CatsContacts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('cats', function($table)
        {
            $table->dropColumn('id_contacts');
            $table->text('contacts')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('cats', function($table)
        {
            $table->dropColumn('contacts');
            $table->integer('id_contacts')->nullable();
        });
	}

}
