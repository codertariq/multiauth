<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Admin::create([
			'first_name' => 'Tariqul',
			'last_name' => 'Islam',
			'nid' => '19928111063000259',
			'dob' => '1992-11-25',
			'gender' => '1',
			'image' => Null,
			'email' => 'tariqulislamrc@gmail.com',
			'mobile' => '01718627564',
			'address' => 'Rajshahi',
			'city' => 'Rajshahi',
			'password' => Hash::make('Tariq1232'),
		]);
	}
}
