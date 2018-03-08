<?php

namespace App\Http\Controllers;

use App\Metric;
use App\Startup;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LandingController extends Controller
{
	public function index()
	{
		$topStartups = Metric::orderBy(Metric::MONTHLY_REVENUE, 'desc')
			->with('startup')
			->where('recorded_at', Carbon::today())
			->limit(5)
			->get();

		$startups = Startup::orderBy('name')->ready()->get();
		$makers = User::orderBy('name')
			->whereHas('startups', function ($query) {
				return $query->ready();
			})->get();

		$data = [
			'topStartups' => $topStartups,
			'startups' => $startups,
			'makers' => $makers,

		];

		return view('welcome', $data);
	}

	public function startup($id)
	{
		$startup = Startup::findOrFail($id);
		$metrics = $startup->metrics()->orderBy('recorded_at', 'asc')->limit(30)->get();
		$last = $startup->metrics()->orderBy('recorded_at', 'desc')->first();

		$data = [
			'revenue'  => $last ? $last->monthly_revenue : 0,
			'startup'  => $startup,
			'user'     => $startup->user,
			'dates'    => array_pluck($metrics, 'date'),
			'currency' => $startup->currency,
			'monthly'  => array_pluck($metrics, Metric::MONTHLY_REVENUE),
			'paid'     => array_pluck($metrics, Metric::PAID_USERS),
			'free'     => array_pluck($metrics, Metric::FREE_USERS),
		];

		return view('landing.startup', $data);
	}


	public function maker($id)
	{
		$user = User::findOrFail($id);
		$startups = $user->startups()->ready()->get();

		$revenue = 0;
		$free = 0;
		$paid = 0;
		foreach ($startups as $startup) {
			$last = $startup->metrics()->orderBy('recorded_at', 'desc')->first();

			if (!$last) continue;

			$revenue += $last->monthly_revenue;
			$free += $last->free_users;
			$paid += $last->paid_users;

			$currency = $startup->currency;
		}

		$data = [
			'user'     => $user,
			'startups' => $startups,
			'revenue'  => $revenue,
			'paid'     => $paid,
			'free'     => $free,
			'currency' => $currency,
		];

		return view('landing.maker', $data);

	}
}
