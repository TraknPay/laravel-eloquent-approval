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
		$model->setEvent('CREATE')->saveApprovalModel();

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
		$model->setEvent('UPDATE')->saveApprovalModel();

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
		$model->setEvent('DELETE')->saveApprovalModel();

		return false;
	}
}