<?php

namespace TraknPay\EloquentApproval;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model {
	/**
	 * @var string
	 */
	protected $primaryKey = 'id';
	/**
	 * @var string
	 */
	protected $table = 'approvals';
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id', 'approver_id', 'reference_id', 'model', 'operation', 'values','changes', 'is_approved', 'approved_by', 'approved_date',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
	];
}
