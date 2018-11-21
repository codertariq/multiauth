<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('admins', function (Blueprint $table) {
			$table->increments('id');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('nid', 17)->unique();
			$table->date('dob');
			$table->boolean('gender')->default('1');
			$table->string('image', 255)->nullable();
			$table->string('email', 50)->unique();
			$table->string('mobile', 13)->unique();
			$table->string('address', 255);
			$table->string('city', 50);
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->boolean('status')->default(1);
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('admins');
	}
}
