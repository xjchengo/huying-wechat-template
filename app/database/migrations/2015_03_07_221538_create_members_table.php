<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('members', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('wechat_account_id')->unsigned()->nullable();
            $table->string('nickname');
            $table->string('head_img_url');
			$table->timestamps();
            $table->foreign('wechat_account_id')->references('id')->on('wechat_accounts');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('members');
	}

}
