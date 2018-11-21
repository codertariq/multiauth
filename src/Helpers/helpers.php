<?php

if (!function_exists('multiauth_asset')) {
	function multiauth_asset($path, $secure = null) {
		return asset(config('multiauth.assets_path') . '/' . $path, $secure);
	}
}
