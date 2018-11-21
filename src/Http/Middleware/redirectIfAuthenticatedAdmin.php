<?php

namespace Tariqul\Multiauth\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class redirectIfAuthenticatedAdmin {
	//dd('redirectIfAuthenticatedAdmin');
	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \Closure                 $next
	 *
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = null) {
		//dd($guard);
		switch ($guard) {
		case 'admin':
			if (Auth::guard($guard)->check()) {
				return redirect(route('admin.dashboard'));
			}
			break;

		default:
			if (Auth::guard($guard)->check()) {
				return redirect('/home');
			}
			break;
		}

		return $next($request);
	}
}
