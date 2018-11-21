<?php

namespace Tariqul\Multiauth\Http\Controllers\Auth;

use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\Request;

trait VerifiesEmails {
	use RedirectsUsers;

	/**
	 * Show the email verification notice.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request) {
		//dd($request->user());
		return $request->user()->hasVerifiedEmail()
		? redirect($this->redirectPath())
		: view('multiauth::admin.auth.verify');
	}

	/**
	 * Mark the authenticated user's email address as verified.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function verify(Request $request) {
		//dd($request->user());
		if ($request->route('id') == $request->user()->getKey() &&
			$request->user()->markEmailAsVerified()) {
			event(new Verified($request->user()));
		}

		return redirect($this->redirectPath())->with('admin_verified', true);
	}

	/**
	 * Resend the email verification notification.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function resend(Request $request) {
		if ($request->user()->hasVerifiedEmail()) {
			return redirect($this->redirectPath());
		}

		$request->user()->sendEmailVerificationNotification();

		return back()->with('resent', true);
	}
}
