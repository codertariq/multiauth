<?php

namespace Tariqul\Multiauth\Console\Commands;

use Illuminate\Console\Command;
use Tariqul\Multiauth\Model\Admin;

class SeedCmd extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'multiauth:seed';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Seed one super admin for multiauth package';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		$admin = $this->createSuperAdmin();

		$this->info("You have created an admin name '{$admin->name} ");
		$this->info("Now log-in with {$admin->email} email and password as 'Tariq1232'");
	}

	protected function createSuperAdmin() {
		$prefix = config('multiauth.prefix');
		$admin = factory(Admin::class)
			->create();
		return $admin;
	}
}
