<?php

namespace TraknPay\EloquentApproval;


use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Support\Facades\Auth;

trait ApprovalTrait {
	use ApprovalEvents;

	/**
	 * @var string
	 */
	private $operation;

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
	 */
	public function saveApprovalModel()
	{
		Approval::create($this->transformApprove());
	}

	/**
	 * resolve the user
	 * @return int|mixed
	 */
	private function resolveUser()
	{
		return Auth::check() ? Auth::user()->getAuthIdentifier() : 0;
	}

	/**
	 * transform approve
	 *
	 * @return array
	 */
	protected function transformApprove(): array
	{
		return [
			'user_id'     => $this->resolveUser(),
			'approver_id' => $this->resolveUser(),
			'model'       => $this->getMorphClass(),
			'operation'   => $this->getOperation(),
			'values'      => serialize($this),
			'is_approved' => 'n',
		];
	}

	/**
	 * get event
	 * @return string
	 */
	public function getOperation()
	{
		return $this->operation;
	}

	/**
	 * set event
	 * @param $eventName
	 * @return $this
	 */
	public function setOperation($eventName)
	{
		$this->operation = $eventName;

		return $this;
	}
}