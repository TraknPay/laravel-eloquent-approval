<?php

namespace TraknPay\EloquentApproval;


use Illuminate\Database\Eloquent\Model;

class ApprovalObserver {

	/**
	 * Handle to the Model "created" event.
	 *
	 * @param Model $model
	 * @return bool
	 */
	public function creating(Model $model)
	{
		$model->saveApprovalModel('CREATE');

		return false;
	}

	/**
	 * Handle the Model "updated" event.
	 *
	 * @param Model $model
	 * @return bool
	 */
	public function updating(Model $model)
	{
		$model->saveApprovalModel('UPDATE');

		return false;
	}

	/**
	 * Handle the Model "deleted" event.
	 *
	 * @param Model $model
	 * @return bool
	 */
	public function deleting(Model $model)
	{
		$model->saveApprovalModel('DELETE');

		return false;
	}
}