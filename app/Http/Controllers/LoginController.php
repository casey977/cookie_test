<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller {
    public function login(Request $request) {
        try {
            // Validate input...
            $validatedData = $request->validate([
                'email' => 'required|email|max:100',
                'password' => 'required|string|max:100'
            ]);

            // Check email...
            $client = DB::table('table')->where('email', $validatedData['email'])->first();
            if (is_null($client)) {
                Log::error('Wrong email!');
                return response()->json(['error' => 'Email not found!'], 401);
            }

            // Check password...
            $passwordState = Hash::check($validatedData['password'], $client->password);
            if ($passwordState) {
                $responseData = [
                    'status' => 'OK',
                    'message' => 'Login successful, JWT generated',
                ];
                $response = response()->json($responseData, 200);
                setcookie('jwt', 'qwerty@qwerty.com', 9001);
                return $response;
            } else {
                Log::error('Wrong password');
                return response()->json(['error' => 'Wrong password!'], 401);
            }
        } catch (ValidationException $error) {
            Log::error('Error validating login details!');
            return response()->json(['error' => 'Login details has wrong format!'], 501);
        } catch (Exception $error) {
            Log::error('Unknown error logging in!');
            return response()->json(['error' => 'Error logging in!'], 500);
        }
    }
}