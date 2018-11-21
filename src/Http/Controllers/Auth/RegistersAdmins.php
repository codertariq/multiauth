<?php

namespace Tariqul\Multiauth\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

trait RegistersAdmins {
	use RedirectsUsers;

	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showRegistrationForm() {
		$roles = Role::all()->except(1);
		return view('multiauth::admin.auth.register', compact('roles'));
	}

	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function register(Request $request) {

		$this->validator($request->all())->validate();
		//dd($this->validator($request->all())->validate());
		event(new Registered($user = $this->create($request->all())));

		//$this->guard()->login($user);

		return $this->registered($request, $user)
		?: redirect($this->redirectPath())->with('success', ucfirst(config('multiauth.prefix')) . $request->first_name . ' Created Successfull');
	}

	/**
	 * Get the guard to be used during registration.
	 *
	 * @return \Illuminate\Contracts\Auth\StatefulGuard
	 */
	protected function guard() {
		return Auth::guard('admin');
	}

	/**
	 * The user has been registered.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  mixed  $user
	 * @return mixed
	 */
	protected function registered(Request $request, $user) {
		//
	}
}
