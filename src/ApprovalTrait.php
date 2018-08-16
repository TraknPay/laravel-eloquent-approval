<?php

namespace TraknPay\EloquentApproval;


use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Support\Facades\Auth;

trait ApprovalTrait {
	use HasEvents;

	/**
	 * boot the trait and register the observer
	 */
	public static function bootApprovalTrait()
	{
		if (!static::isApprover()) {
			static::observe(new ApprovalObserver());
		}

	}

	/**
	 * check whether user is approver
	 *
	 * @return bool
	 */
	public static function isApprover(): bool
	{
		return true;
	}

	/**
	 * save approval model
	 *
	 * @param $operation
	 */
	public function saveApprovalModel($operation)
	{
		Approval::create([
			'user_id'     => $this->resolveUser(),
			'approver_id' => $this->resolveUser(),
			'model'       => $this->getMorphClass(),
			'operation'   => $operation,
			'values'      => serialize($this),
			'is_approved' => 'n',
		]);
	}

	/**
	 * resolve the user
	 * @return int|mixed
	 */
	private function resolveUser()
	{
		return Auth::check() ? Auth::user()->getAuthIdentifier() : 0;
	}
}