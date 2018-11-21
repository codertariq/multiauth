<?php

namespace Tariqul\Multiauth\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tariqul\Multiauth\Notifications\AdminResetPasswordNotification;
use Tariqul\Multiauth\Notifications\AdminVerifyEmail;

class Admin extends Authenticatable implements MustVerifyEmail {
	use Notifiable;
	use HasRoles;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'first_name', 'last_name', 'nid', 'dob', 'gender', 'image', 'email', 'mobile', 'address', 'city', 'password', 'status',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function sendPasswordResetNotification($token) {
		$this->notify(new AdminResetPasswordNotification($token));
	}

	/**
	 * Send the email verification notification.
	 *
	 * @return void
	 */
	public function sendEmailVerificationNotification() {
		$this->notify(new AdminVerifyEmail);
	}
}
