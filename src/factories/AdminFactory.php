<?php

use Illuminate\Support\Facades\Hash;
use Tariqul\Multiauth\Model\Admin;

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Admin::class, function (Faker\Generator $faker) {
	return [
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
	];
});
