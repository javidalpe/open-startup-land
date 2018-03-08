<?php

namespace App\Http\Controllers;

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
}
