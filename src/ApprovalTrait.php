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
		// If the "sendingForApproval" event returns false we'll bail out of the save and return
		// false, indicating that the approval failed. This provides a chance for any
		// listeners to cancel save operations if validations fail or whatever.
		if ($this->fireModelEvent('sendingForApproval') === false) {
			return false;
		}
		Approval::create($this->transformApprove());
		/* fire a sent for approval event */
		$this->fireModelEvent('sentForApproval', false);
	}

	/**
	 * resolve the user
	 * @return int|mixed
	 */
	private function identifyUser()
	{
		return Auth::check() ? Auth::user()->getAuthIdentifier() : 0;
	}

	/**
	 * transform approve
	 *
	 * @return array
	 */
	public function transformApprove(): array
	{
		$optional_data = $this->optionalApprovalData();
		return array_merge([
			'user_id'     => $this->identifyUser(),
			'approver_id' => null,
			'model'       => $this->getMorphClass(),
			'operation'   => $this->getOperation(),
			'values'      => serialize($this),
			'changes'     => serialize($this->getDirty()),
			'is_approved' => 'n',
		],$optional_data);
	}

	/**
	 * This function can be overridden by user to pass additional data like reference_id
     * @return array
     */
	public function optionalApprovalData(){
	    return [];
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