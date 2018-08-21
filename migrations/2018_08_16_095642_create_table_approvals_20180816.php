<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableApprovals20180816 extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('approvals', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('user_id')->unsigned();
			$table->integer('approver_id')->unsigned()->nullable();
			$table->string('model');
			$table->string('operation');
			$table->text('values');
			$table->text('changes')->nullable();
			$table->string('is_approved', 1)->default('n')->nullable();
			$table->integer('approved_by')->unsigned()->nullable();
			$table->timestamp('approved_date')->nullable();
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
		Schema::dropIfExists('approvals');
	}
}
