<?php

namespace Tariqul\Multiauth\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class cheackIfSuspend {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {

		$user = Auth::user();
		//dd($user);
		// You might want to create a method on your model to
		// prevent direct access to the `logout` property. Something
		// like `markedForLogout()` maybe.
		if ($user->status == 0) {
			// Not for the next time!
			// Maybe a `unmarkForLogout()` method is appropriate here.
			Auth::logout();
			return redirect()->route('admin.login');
		}

		return $next($request);
	}
}