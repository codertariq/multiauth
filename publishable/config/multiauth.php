<?php

return [
	/*
		    |--------------------------------------------------------------------------
		    | Registration Notification Email
		    |--------------------------------------------------------------------------
		    |
		    | While registering new admin by superadmin, you can send an email to
		    | the new registered admin with the password you have selected
		    | If you make it 'true' then it will send email otherwise
		    | It will not going to send any email to the admin
		    | Default : false
	*/
	'registration_notification_email' => false,

	/*
		    |--------------------------------------------------------------------------
		    | Redirect After Login
		    |--------------------------------------------------------------------------
		    |
		    | It will redirect to a path defined here after login.
		    | You can change it to where ever you want to
		    | redirect the admin after login.
		    | Default : /admin/home
	*/
	'redirect_after_login' => '/admin',

	/*
		    |--------------------------------------------------------------------------
		    | User config
		    |--------------------------------------------------------------------------
		    |
		    | Here you can specify voyager user configs
		    |
	*/
	/*
		    |--------------------------------------------------------------------------
		    | Controllers config
		    |--------------------------------------------------------------------------
		    |
		    | Here you can specify voyager controller settings
		    |
	*/

	'controllers' => [
		'namespace' => 'Tariqul\\Multiauth\\Http\\Controllers',
	],

	/*
		    |--------------------------------------------------------------------------
		    | Models config
		    |--------------------------------------------------------------------------
		    |
		    | Here you can specify default model namespace when creating BREAD.
		    | Must include trailing backslashes. If not defined the default application
		    | namespace will be used.
		    |
	*/

	'models' => [
		//'namespace' => 'App\\',
	],

	/*
		    |--------------------------------------------------------------------------
		    | Path to the Voyager Assets
		    |--------------------------------------------------------------------------
		    |
		    | Here you can specify the location of the voyager assets path
		    |
	*/

	'assets_path' => '/vendor/tariqul/multiauth/assets',

	/*
		    |--------------------------------------------------------------------------
		    | Multilingual configuration
		    |--------------------------------------------------------------------------
		    |
		    | Here you can specify if you want Voyager to ship with support for
		    | multilingual and what locales are enabled.
		    |
	*/

	'multilingual' => [
		/*
			         * Select default language
		*/
		'default' => 'en',

		/*
			         * Select languages that are supported.
		*/
		'locales' => [
			'en',
			'bn',
		],
	],
];
