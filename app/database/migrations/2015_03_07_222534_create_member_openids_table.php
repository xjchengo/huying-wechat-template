<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberOpenidsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('member_openids', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('wechat_account_id')->unsigned()->nullable();
            $table->string('member_id');
            $table->string('openid')->unqiue();
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
		Schema::drop('member_openids');
	}

}
