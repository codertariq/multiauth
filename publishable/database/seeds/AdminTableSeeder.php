<?php

use App\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Permission::create(['guard_name' => 'admin', 'name' => 'add admin']);
		Permission::create(['guard_name' => 'admin', 'name' => 'edit admin']);
		Permission::create(['guard_name' => 'admin', 'name' => 'view admin']);
		Permission::create(['guard_name' => 'admin', 'name' => 'delete admin']);
		Permission::create(['guard_name' => 'admin', 'name' => 'add role']);
		Permission::create(['guard_name' => 'admin', 'name' => 'edit role']);
		Permission::create(['guard_name' => 'admin', 'name' => 'delete role']);
		Permission::create(['guard_name' => 'admin', 'name' => 'view role']);
		$role = Role::create(['guard_name' => 'admin', 'name' => 'Super Admin']);
		$role->givePermissionTo(Permission::all());
		$admin = Admin::create([
			'first_name' => 'Tariqul',
			'last_name' => 'Islam',
			'nid' => '19928111063000259',
			'dob' => '1992-11-25',
			'gender' => '1',
			'image' => Null,
			'email' => 'tariqulislamrc@gmail.com',
			'mobile' => '01718627564',
			'address' => 'Rajshahi',
			'city' => 'Rajshahi',
			'password' => Hash::make('Tariq1232'),
		]);
		//$admin->syncRoles(Role::all());

	}
}
