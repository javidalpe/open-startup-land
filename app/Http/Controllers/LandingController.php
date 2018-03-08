<?php

namespace App\Http\Controllers;

use App\Metric;
use App\Startup;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $newStartups = Startup::ready()->orderBy('id', 'desc')->limit(4)->get();

        $data = [
            'new' => $newStartups
        ];
        return view('welcome', $data);
    }

    public function startup($slug, $id)
    {
        $startup = Startup::findOrFail($id);
        $metrics = $startup->metrics()->orderBy('recorded_at', 'desc')->limit(30)->get();

        $data = [
            'startup' => $startup,
            'dates' => array_pluck($metrics, 'date'),
            'currency' => $startup->currency,
            'monthly' => array_pluck($metrics, Metric::MONTHLY_REVENUE),
            'paid' => array_pluck($metrics, Metric::PAID_USERS),
            'free' => array_pluck($metrics, Metric::FREE_USERS),
        ];
        return view('landing.startup', $data);
    }
}
