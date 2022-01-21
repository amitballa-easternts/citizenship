<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserLogin;
use Hash;
use Illuminate\Auth\Events\Validated;

class Login extends Controller
{

    public function checkLogin(Request $request)
    {
        $logged = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $login = UserLogin::where('email', $request->email)->first();
        $login->sendEmailVerificationNotification();
        /*  try {
            $user->$user->createToken('Auth Token')->accessToken;
        } catch (\Exception $e) {
            return response()->json(['error' => config('constants.login.invalid_user')]);
        } */


        /*        if (!Auth::attempt($logged)) {
            return response()->json(['message' => 'Invalid Login']);
        }
        $accessToken = $logged->createToken('authToken')->accessToken;
        return response(['user_logins' => Auth::user(), 'access_token' => $accessToken]); */
        /* $login = UserLogin::where('email', $request->email)->first();

        $tokenResult = $request->email->createToken('Personal Access Token');
        $token = $tokenResult->token;

        return $token; */
        /*         if (!$login) {
            return response()->json(['error' => config('constants.login.invalid_user')]);
        } else {
            if (Hash::check($request->password, $login->password)) {
                return response()->json(['success' => config('constants.login.login_success')]);
            } else {
                return response()->json(['error' => config('constants.login.password_not_match')]);
            }
        } */
    }
}
