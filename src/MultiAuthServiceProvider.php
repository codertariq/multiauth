<?php

namespace Tariqul\Multiauth;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\ServiceProvider;
use Tariqul\Multiauth\Console\Commands\MakeMultiAuthCommand;
use Tariqul\Multiauth\Console\Commands\RollbackMultiAuthCommand;
use Tariqul\Multiauth\Console\Commands\SeedCmd;
use Tariqul\Multiauth\Exception\MultiAuthHandler;
use Tariqul\Multiauth\Http\Middleware\AdminEmailVerifyMiddleware;
use Tariqul\Multiauth\Http\Middleware\cheackIfSuspend;
use Tariqul\Multiauth\Http\Middleware\redirectIfAuthenticatedAdmin;

class MultiAuthServiceProvider extends ServiceProvider {

	public function boot() {
		$this->loadRoutesFrom(__DIR__ . '/../routes/admin.php');
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'multiauth');
		$this->loadTranslationsFrom(realpath(__DIR__ . '/../publishable/lang'), 'multilang');
		$this->loadMigrationsFrom(__DIR__ . '/../publishable//migrations');

		$this->loadAdminCommands();
		$this->loadCommands();
		//$this->mergeConfigFrom(dirname(__DIR__) . '/publishable/config/auth.php', 'auth');

		// $this->mergeAuthFileFrom(__DIR__ . '/../config/auth.php', 'auth');
		// $this->mergeConfigFrom(__DIR__ . '/../config/multiauth.php', 'multiauth');

		//$this->registerExceptionHandler();
	}

	public function register() {
		$this->registerConfigs();
		$this->registerPublishableResources();
		$this->loadHelpers();
		$this->loadMiddleware();
		$this->registerExceptionHandler();
		$this->loadFactories();
	}

	/**
	 * Register the publishable files.
	 */
	private function registerPublishableResources() {
		$publishablePath = dirname(__DIR__) . '/publishable';

		$publishable = [
			'multiauth_assets' => [
				"{$publishablePath}/assets/" => public_path(config('multiauth.assets_path')),
			],
			'config' => [
				"{$publishablePath}/config/multiauth.php" => config_path('multiauth.php'),
			],
			'views' => [
				"{$publishablePath}/../resources/views" => resource_path('views/vendor/multiauth'),
			],
			'migration' => [
				"{$publishablePath}/database/migrations/" => database_path('migrations'),
			],
			'multiauth-seed' => [
				"{$publishablePath}/database/seeds/" => database_path('seeds'),
			],

		];

		foreach ($publishable as $group => $paths) {
			//dd($paths);
			$this->publishes($paths, $group);
		}
	}

	/**
	 * Load helpers.
	 */
	protected function loadHelpers() {
		foreach (glob(__DIR__ . '/Helpers/*.php') as $filename) {
			require_once $filename;
		}
	}

	public function registerConfigs() {
		$this->mergeConfigFrom(dirname(__DIR__) . '/publishable/config/multiauth.php', 'multiauth');
		$this->mergeAuthFileFrom(dirname(__DIR__) . '/publishable/config/auth.php', 'auth');
	}

	protected function mergeAuthFileFrom($path, $key) {
		//dd($path);
		$original = $this->app['config']->get($key, []);
		$this->app['config']->set($key, $this->multi_array_merge(require $path, $original));
	}
	protected function multi_array_merge($toMerge, $original) {
		$auth = [];
		foreach ($original as $key => $value) {
			if (isset($toMerge[$key])) {
				$auth[$key] = array_merge($value, $toMerge[$key]);
			} else {
				$auth[$key] = $value;
			}
		}

		return $auth;
	}

	protected function loadMiddleware() {
		//dd('Tariq');
		app('router')->aliasMiddleware('guest', redirectIfAuthenticatedAdmin::class);
		app('router')->aliasMiddleware('suspend', cheackIfSuspend::class);
		app('router')->aliasMiddleware('admin_verified', AdminEmailVerifyMiddleware::class);
	}

	protected function registerExceptionHandler() {
		\App::singleton(
			\Illuminate\Contracts\Debug\ExceptionHandler::class,
			MultiAuthHandler::class
		);
	}
	protected function loadAdminCommands() {
		if ($this->app->runningInConsole()) {
			$this->commands([
				SeedCmd::class,
			]);
		}
	}

	protected function loadCommands() {
		if ($this->app->runningInConsole()) {
			$this->commands([
				MakeMultiAuthCommand::class,
				RollbackMultiAuthCommand::class,
			]);
		}
	}

	protected function loadFactories() {
		$appFactories = scandir(database_path('/factories'));
		$factoryPath = !in_array('AdminFactory.php', $appFactories) ? __DIR__ . '/factories' : database_path('/factories');

		$this->app->make(Factory::class)->load($factoryPath);
	}

}