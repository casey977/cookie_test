<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Users;

class CreateController extends Controller {
    public function createUser(Request $request) {
		try {
			$validated = $request->validate([
				'email' => 'required|email:rfc|max:255',
                'email2' => 'required|email:rfc|max:255',
				'password' => 'required|string|min:8',
                'password2' => 'required|string|min:8'
			]);

            if ($request['email'] !== $request['email2']) {
                Log::debug('Passwords not the same!');
				return response()->json(['message' => 'Passwords not the same!'], 402);
            }
			
			$emailStatus = Users::firstWhere('email', $validated['email']);

			if (is_null($emailStatus)) {
				$newUser = new Users;
				$newUser->email = $validated['email'];
				$newUser->password = bcrypt($validated['password']);
				$newUser->save();
	
				if ($newUser->wasRecentlyCreated) {
					Log::debug('User created!');
					return response()->json(['message' => 'OK'], 200);
				} else {
					Log::debug('Error creating user!');
					return response()->json(['message' => 'Error creating user!'], 505);
				}
			} else {
				Log::error('Email already used!');
				return response()->json(['message' => 'Email already used!'], 422);
			}
		} catch (Exception $error) {
			Log::error('Error creating user!');
			return response()->json(['error' => 'An error occurred while creating the user'], 505);
		}
	}
}