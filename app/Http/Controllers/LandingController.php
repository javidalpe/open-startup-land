<?php

namespace App\Http\Controllers;

use App\Criteria\HasReadyStartupsCriteria;
use App\Metric;
use App\Repositories\StartupRepository;
use App\Repositories\UserRepository;
use App\Startup;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LandingController extends Controller
{
	private $startupRepository;
	private $userRepository;

	public function __construct(StartupRepository $startupRepo, UserRepository $userRepository)
	{
		$this->startupRepository = $startupRepo;
		$this->userRepository = $userRepository;
	}

	public function index()
	{
		$topStartups = Metric::orderBy(Metric::MONTHLY_REVENUE, 'desc')
			->with('startup')
			->where('recorded_at', Carbon::today())
			->limit(5)
			->get();

		$startups = Startup::orderBy('name')->ready()->get();

		$topMakers = $this->userRepository->orderBy(Metric::MONTHLY_REVENUE, 'desc')->get();

		$this->userRepository->pushCriteria(new HasReadyStartupsCriteria());
		$makers = $this->userRepository->orderBy('name')->get();

		$data = [
			'topMakers' => $topMakers,
			'topStartups' => $topStartups,
			'startups'    => $startups,
			'makers'      => $makers,

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
		$first = $user->startups()->ready()->first();

		if ($first) {
			$currency = $first->currency;
		} else {
			$currency = 'USD';
		}

		$data = [
			'user'     => $user,
			'startups' => $startups,
			'currency' => $currency,
		];

		return view('landing.maker', $data);

	}
}
