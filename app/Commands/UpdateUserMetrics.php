<?php


namespace App\Commands;


use App\Metric;
use App\User;
use DB;

class UpdateUserMetrics implements ICommand
{
	private $user;

	/**
	 * UpdateUserMetrics constructor.
	 *
	 * @param $user
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function execute()
	{
		$startups = $this->user->startups()->ready()->get();
		$revenue = 0;
		$free = 0;
		$paid = 0;
		foreach ($startups as $startup) {
			$last = $startup->metrics()->orderBy('recorded_at', 'desc')->first();

			if (!$last) continue;

			$revenue += $last->monthly_revenue;
			$free += $last->free_users;
			$paid += $last->paid_users;
		}

		$this->user->update([
			Metric::MONTHLY_REVENUE => $revenue,
			Metric::PAID_USERS => $paid,
			Metric::FREE_USERS => $free,
		]);
	}
}