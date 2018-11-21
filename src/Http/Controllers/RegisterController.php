<?php

namespace Tariqul\Multiauth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Tariqul\Multiauth\Http\Controllers\Auth\RegistersAdmins;
use Tariqul\Multiauth\Model\Admin;
use Tariqul\Multiauth\Notifications\RegistrationNotification;

class RegisterController extends Controller {
	/*
		    |--------------------------------------------------------------------------
		    | Register Controller
		    |--------------------------------------------------------------------------
		    |
		    | This controller handles the registration of new users as well as their
		    | validation and creation. By default this controller uses a trait to
		    | provide this functionality without requiring any additional code.
		    |
	*/

	use RegistersAdmins;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/admin/admin';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth:admin');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		return Validator::make($data, [
			'first_name' => ['required', 'string', 'max:255'],
			'last_name' => ['required', 'string', 'max:255'],
			'dob' => ['required', 'date'],
			'nid' => ['required', 'string', 'max:17', 'min:17', 'unique:admins'],
			'address' => ['required', 'string', 'max:255'],
			'city' => ['required', 'string', 'max:255'],
			'gender' => ['required', 'integer', 'max:1'],
			'image' => ['sometimes', 'mimes:jpeg,bmp,png'],
			'mobile' => ['required', 'string', 'max:11', 'min:11', 'unique:admins'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
			'password' => ['required', 'string', 'min:6', 'confirmed'],
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return \App\User
	 */
	protected function create(array $data) {
		//dd($data);
		if (isset($data['image'])) {
			$image = $data['image'];
			$filepath = 'profile' . DIRECTORY_SEPARATOR . date('FY') . DIRECTORY_SEPARATOR;
			$data['image'] = $image->store($filepath);
		} else {
			$data['image'] = Null;
		}

		// if (isset($data['send_mail'])) {
		// 	$data['send_mail'] == 1;
		// } else {
		// 	$data['send_mail'] == 0;
		// }

		$admin = new Admin;
		$fields = $this->tableFields();
		$data['password'] = bcrypt($data['password']);
		foreach ($fields as $field) {
			if (isset($data[$field])) {
				$admin->$field = $data[$field];
			}
		}
		$admin->save();
		if (isset($data['roles'])) {
			$admin->syncRoles($data['roles']);
		}

		$this->sendConfirmationNotification($admin, request('password'));

		return $admin;
	}

	protected function sendConfirmationNotification($admin, $password) {
		if ($admin->send_mail == 1) {
			try {
				$admin->notify(new RegistrationNotification($password));
			} catch (\Exception $e) {
				request()->session()->flash('message', 'Email not sent properly, Please check your mail configurations');
			}
		}
	}

	protected function tableFields() {
		return collect(\Schema::getColumnListing('admins'));
	}

}
