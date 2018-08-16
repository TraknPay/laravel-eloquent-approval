<?php

namespace TraknPay\EloquentApproval;

use Illuminate\Support\ServiceProvider;

class ApprovalServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->handleMigration();
	}

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton(ApprovalObserver::class, function () {
			return new ApprovalObserver();
		});
	}

	/**
	 * publish the migration
	 */
	private function handleMigration()
	{
		$this->publishes([__DIR__ . '/../migrations' => base_path('database/migrations')]);
	}
}
