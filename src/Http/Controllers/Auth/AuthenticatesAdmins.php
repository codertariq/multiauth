<?php

namespace Tariqul\Multiauth\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Tariqul\Multiauth\Model\Admin;

trait AuthenticatesAdmins {
	use RedirectsUsers, ThrottlesLogins;

	/**
	 * Show the application's login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showLoginForm() {
		return view('multiauth::admin.auth.login');
	}

	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	public function login(Request $request) {
		$this->validateLogin($request);

		// If the class is using the ThrottlesLogins trait, we can automatically throttle
		// the login attempts for this application. We'll key this by the username and
		// the IP address of the client making these requests into this application.
		if ($this->hasTooManyLoginAttempts($request)) {
			$this->fireLockoutEvent($request);

			return $this->sendLockoutResponse($request);
		}

		if ($this->attemptLogin($request)) {
			return $this->sendLoginResponse($request);
		}

		// If the login attempt was unsuccessful we will increment the number of attempts
		// to login and redirect the user back to the login form. Of course, when this
		// user surpasses their maximum number of attempts they will get locked out.
		$this->incrementLoginAttempts($request);

		return $this->sendFailedLoginResponse($request);
	}

	/**
	 * Validate the user login request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return void
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	protected function validateLogin(Request $request) {
		$request->validate([
			$this->username() => 'required|string',
			'password' => 'required|string',
		]);
	}

	/**
	 * Attempt to log the user into the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return bool
	 */
	protected function attemptLogin(Request $request) {
		return $this->guard()->attempt(
			$this->credentials($request), $request->filled('remember')
		);
	}

	/**
	 * Get the needed authorization credentials from the request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	protected function credentials(Request $request) {
		$admin = Admin::where('email', $request->email)->first();
		if ($admin != null) {
			if ($admin->status != 1) {
				return ['email' => 'inactive', 'password' => 'suspend'];
			} else {
				return ['email' => $request->email, 'password' => $request->password, 'status' => 1];
			}
		} else {
			return ['email' => $request->email, 'password' => $request->password, 'status' => 0];
		}
	}

	/**
	 * Send the response after the user was authenticated.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	protected function sendLoginResponse(Request $request) {
		$request->session()->regenerate();

		$this->clearLoginAttempts($request);

		return $this->authenticated($request, $this->guard()->user())
		?: redirect()->intended($this->redirectPath());
	}

	/**
	 * The user has been authenticated.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  mixed  $user
	 * @return mixed
	 */
	protected function authenticated(Request $request, $user) {
		//
	}

	/**
	 * Get the failed login response instance.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 * @throws \Illuminate\Validation\ValidationException
	 */
	protected function sendFailedLoginResponse(Request $request) {
		/*throw ValidationException::withMessages([
			$this->username() => [trans('auth.failed')],
		]);*/

		$fields = $this->credentials($request);
		if ($fields['email'] == 'inactive' && $fields['password'] == 'suspend') {
			throw ValidationException::withMessages([
				$this->username() => [trans('multilang::admin.suspend')],
			]);
			//$errors => $request->passwords;
		} else {
			throw ValidationException::withMessages([
				$this->username() => [trans('auth.failed')],
			]);
		}
	}

	/**
	 * Get the login username to be used by the controller.
	 *
	 * @return string
	 */
	public function username() {
		return 'email';
	}

	/**
	 * Log the user out of the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function logout(Request $request) {
		$this->guard()->logout();

		//$request->session()->invalidate();

		return $this->loggedOut($request) ?: redirect(route('admin.login'));
	}

	/**
	 * The user has logged out of the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return mixed
	 */
	protected function loggedOut(Request $request) {
		//
	}

	/**
	 * Get the guard to be used during authentication.
	 *
	 * @return \Illuminate\Contracts\Auth\StatefulGuard
	 */
	protected function guard() {
		return Auth::guard('admin');
	}
}
