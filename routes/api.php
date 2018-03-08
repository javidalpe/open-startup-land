<?php

use App\Metric;
use App\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/open', function (Request $request) {
    return response()->json([
        Metric::MONTHLY_REVENUE => 0,
        Metric::PAID_USERS => 0,
        Metric::FREE_USERS => User::count()
    ]);
});


//Route::resource('startups', 'StartupAPIController');