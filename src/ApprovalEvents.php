<?php

namespace TraknPay\EloquentApproval;


trait ApprovalEvents {

	/**
	 * Register a sendingForApproval model event with the dispatcher.
	 *
	 * @param  \Closure|string $callback
	 * @return void
	 */
	public static function sendingForApproval($callback)
	{
		static::registerModelEvent('sendingForApproval', $callback);
	}

	/**
	 * Register a sentForApproval model event with the dispatcher.
	 *
	 * @param  \Closure|string $callback
	 * @return void
	 */
	public static function sentForApproval($callback)
	{
		static::registerModelEvent('sentForApproval', $callback);
	}
}