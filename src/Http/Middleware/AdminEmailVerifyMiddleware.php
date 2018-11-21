<?php

namespace Tariqul\Multiauth\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Redirect;

class AdminEmailVerifyMiddleware {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if (!$request->user() ||
			($request->user() instanceof MustVerifyEmail &&
				!$request->user()->hasVerifiedEmail())) {
			return $request->expectsJson()
			? abort(403, 'Your email address is not verified.')
			: Redirect::route('admin.verification.notice');
		}
		//dd($next($request));
		return $next($request);
	}
}
