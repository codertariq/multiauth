<?php

return [
	//login page
	'login_title' => 'এডমিন লগইন',
	'login_msg' => 'আপনার পরিচয়',
	'login_username' => 'ব্যবহারকারীর ইমেইল',
	'login_password' => 'পাসওয়ার্ড',
	'login_remember' => 'আমাকে মনে রাখুন',
	'login_forgot' => 'পাসওয়ার্ড ভূলে গেছেন?',
	'login_submit' => 'সাইন ইন',
	'login_with' => ' অথবা সাইন ইন করুন ',
	'login_no_account' => "কোন একাউন্ট নেই?",
	'login_register' => 'সাইন আপ',
	'login_terms' => 'সাইন ইন করার মাধ্যমে আপনি নিশ্চিত করছেন যে আপনি আমাদের <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a> পড়েছেন।',

	//password recover page
	'recover_title' => 'পাসওয়ার্ড পুনরুদ্ধার',
	'recover_msg' => 'আমরা আপনাকে ইমেইল এ নির্দেশাবলী পাঠাবো',
	'recover_submit' => 'পাসওয়ার্ড রিসেট করুন',

	//password reset page
	'reset_title' => 'আপনার পাসওয়ার্ড পুনরায় সেট করুন',
	'reset_submit' => 'পাসওয়ার্ড পুনরায় সেট করুন',
	'reset_con_password' => 'পাসওয়ার্ড নিশ্চিত করুন',

	//verify email page
	'verify_title' => 'আপনার ইমেল ঠিকানা যাচাই করুন',
	'verify_msg' => 'এগিয়ে যাওয়ার আগে, একটি যাচাইকরণ লিঙ্কের জন্য আপনার ইমেল চেক করুন। যদি আপনি ইমেলটি না পান তবে অন্যে আর একটি অনুরোধ করতে <a href="' . route('admin.verification.resend') . ' "> এখানে ক্লিক করুন।</a>',
	'verify_status' => 'একটি নতুন যাচাইকরণ লিঙ্ক আপনার ইমেল ঠিকানা পাঠানো হয়েছে।',

	//suspend

	'suspend' => 'আপনার একাউন্টটি সাসপেন্ড করা হয়েছে। অনুগ্রহ করে এডমিন এর সাথে যোগাযোগ করুন।',

	'edit_title' => "এর একাউন্ট সম্পাদন",
	'assign_role_to' => "রোল যোগ করুন",
	'assign_role_msg' => "সকল ঘর পূরণ করতে হবে",
	'create_role' => "রোল প্রদান করুন",
	'create_title' => "নতুন এডমিন যোগ করুন",
	'create_msg' => 'সকল ঘর পূরণ করতে হবে',
	'create_role_title' => 'রোল তৈরি করুন',
	'create_role_msg' => 'সকল ঘর পূরণ করতে হবে',
	'edit_role_title' => 'রোল সম্পাদন',
	'edit_role_msg' => 'সকল ঘর পূরণ করতে হবে',
	'update_role' => 'সম্পাদন করুন',

];
