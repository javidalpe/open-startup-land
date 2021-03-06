<?php


namespace App\Criteria;


use App\User;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class OfUser  implements CriteriaInterface
{

	private $user;

	/**
	 * OfUser constructor.
	 *
	 * @param $user
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}


	/**
	 * Apply criteria in query repository
	 *
	 * @param                     $model
	 * @param RepositoryInterface $repository
	 *
	 * @return mixed
	 */
	public function apply($model, RepositoryInterface $repository)
	{
		return $model->where('user_id', $this->user->id);
	}
}