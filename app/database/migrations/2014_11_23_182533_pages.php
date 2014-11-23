<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('pages', function($table)
        {
            $table->increments('id');
            $table->string('key')->unique();
            $table->string('alias');
            $table->string('title')->nullable();
            $table->text('keywords')->nullable();
            $table->string('description')->nullable();
        });

        Page::insert([
            [ 'key' => 'add_cat', 'alias' => '/add-cat' ],
            [ 'key' => 'feed', 'alias' => '/feed' ],
            [ 'key' => 'profile', 'alias' => '/profile' ],
            [ 'key' => 'map', 'alias' => '/map' ],
            [ 'key' => 'about', 'alias' => '/about' ],
            [ 'key' => 'search', 'alias' => '/search' ],
            [ 'key' => 'index', 'alias' => '/' ],
        ]);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pages');
	}

}
