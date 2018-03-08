<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;

class HasReadyStartupsCriteria implements CriteriaInterface
{

	/**
	 * Apply criteria in query repository
	 *
	 * @param                                                   $model
	 * @param \Prettus\Repository\Contracts\RepositoryInterface $repository
	 *
	 * @return mixed
	 */
	public function apply($model, \Prettus\Repository\Contracts\RepositoryInterface $repository)
	{
		return $model->whereHas('startups', function ($query) {
			return $query->ready();
		});
	}
}