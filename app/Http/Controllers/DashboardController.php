<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cookie;
use App\Models\Users;

class DashboardController extends Controller {
    public function dashboard(Request $request) {
		$token = $request->cookie('jwt');
		Log::debug($token); // Prints blank/nothing
		if ($request->hasCookie('jwt')) {
			Log::debug('Has cookie!');
			$token = $request->cookie('jwt');
			Log::debug($token); // Prints blank/nothing
			// Use data here...
			return view('dashboard');
		} else {
			Log::error('No cookie!');
		}
	}
}