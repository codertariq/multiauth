<?php

return [
	//login page
	'login_title' => 'Admin Login',
	'login_msg' => 'Your Credentials',
	'login_username' => 'Email',
	'login_password' => 'Password',
	'login_remember' => 'Remember Me',
	'login_forgot' => 'Forgot password?',
	'login_submit' => 'Sign in',
	'login_with' => ' or sign in with ',
	'login_no_account' => "Don't have an account? ",
	'login_register' => 'Sign Up',
	'login_terms' => 'By continuing, you' . "'" . 're confirming that you' . "'" . 've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a>',
	//password recover page
	'recover_title' => 'Password recovery',
	'recover_msg' => 'We' . "'" . 'll send you instructions in email',
	'recover_submit' => 'Reset Password',

	//password reset page
	'reset_title' => 'Reset Your Password',
	'reset_submit' => 'Reset Password',
	'reset_con_password' => 'Confirm Password',

	//verify email page
	'verify_title' => 'Verify Your Email Address',
	'verify_msg' => 'Before proceeding, please check your email for a verification link. If you did not receive the email, <a href="' . route('admin.verification.resend') . ' "> click here to request another</a>.',
	'verify_status' => 'A fresh verification link has been sent to your email address.',

	//suspend

	'suspend' => 'You are not a Active user. please contact with Admin',

	'edit_title' => "'s Edit Account",
	'assign_role_to' => "Assign Role To",
	'assign_role_msg' => "All Fields Are Required",
	'create_role' => "Assign Role",
	'create_title' => "Create New Admin",
	'create_msg' => 'All Fields Are Require',
	'create_role_title' => 'Create Role',
	'create_role_msg' => 'All Fields Are Require',
	'edit_role_title' => 'Edit Role',
	'edit_role_msg' => 'All Fields Are Require',
	'update_role' => 'Update Role',

];
