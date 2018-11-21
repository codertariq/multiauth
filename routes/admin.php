<?php

Route::get('lang/{lang}', function () {
	return view('multiauth::admin.dashboard');
})->name('lang');

Route::group([
	'namespace' => 'Tariqul\Multiauth\Http\Controllers',
	'middleware' => ['web'],
	'prefix' => 'admin',
], function () {
	// Authentication Routes...
	Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'LoginController@login');
	Route::post('logout', 'LoginController@logout')->name('admin.logout');

	// Registration Routes...
	if ($options['register'] ?? true) {
		Route::get('register', 'RegisterController@showRegistrationForm')->name('admin.register');
		Route::post('register', 'RegisterController@register');
	}

	// Password Reset Routes...
	Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('admin.password.reset');
	Route::post('password/reset', 'ResetPasswordController@reset')->name('admin.password.update');

	// Email Verification Routes...
	if ($options['verify'] ?? true) {
		Route::get('email/verify', 'VerificationController@show')->name('admin.verification.notice');
		Route::get('email/verify/{id}', 'VerificationController@verify')->name('admin.verification.verify');
		Route::get('email/resend', 'VerificationController@resend')->name('admin.verification.resend');
	}

});
Route::group([
	'namespace' => 'Tariqul\Multiauth\Http\Controllers\Admin',
	'middleware' => ['web', 'suspend'],
	'prefix' => 'admin'], function () {
	// Admin Routes...
	Route::get('/', 'DashboardController@index')->name('admin.dashboard')->middleware('admin_verified');
	Route::get('/admin', 'AdminController@index')->name('admin.index');
	Route::get('/admin/{admin}', 'AdminController@index')->name('admin.show');
	Route::get('/admin/{admin}/edit', 'AdminController@edit')->name('admin.edit');
	Route::put('/admin/{admin}', 'AdminController@update')->name('admin.update');
	Route::get('/edit/profile', 'AdminController@userEdit')->name('admin.useredit');
	Route::put('/admin/edit/profile', 'AdminController@userUpdate')->name('admin.userupdate');
	Route::put('/admin/action/{admin}', 'AdminController@action')->name('admin.action');
	Route::delete('/admin/{admin}', 'AdminController@destroy')->name('admin.destroy');
	Route::get('/change_password', 'AdminController@changePassword')->name('admin.password');
	Route::put('/change_password', 'AdminController@updatePassword');
	Route::get('/get/admin', 'AdminController@getUsers')->name('admin.get');
	Route::get('/assign/role/{admin}', 'AdminController@assignRole')->name('admin.assign.role');
	Route::put('/assign/role/{admin}', 'AdminController@syncRole');

	// Role Routes...
	Route::get('/role', 'RoleController@index')->name('role.index');
	Route::get('/role/create', 'RoleController@create')->name('role.create');
	Route::post('/role/store', 'RoleController@store')->name('role.store');
	Route::get('/role/{role}', 'RoleController@show')->name('role.show');
	Route::get('/role/{role}/edit', 'RoleController@edit')->name('role.edit');
	Route::put('/role/{role}', 'RoleController@update')->name('role.update');
	Route::delete('/role/{role}', 'RoleController@destroy')->name('role.destroy');
	Route::get('/get/role', 'RoleController@getRoles');
});