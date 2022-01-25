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




        /* if (Auth::attempt(['email' => $request->email, Hash::check('password', $request->password)])) {
            $user = Auth::user();
            $accessToken = $user->createToken('authToken')->accessToken;
            response(['user_logins' => Auth::user(), 'access_token' => $accessToken]);
            return response()->json(['success' => config('constants.success')]);
        } else {
            return response()->json(['error' => config('constants.login.invalid_user')]);
        }
 */



        $login = UserLogin::where('email', $request->email)->first();


        if (!$login) {
            return response()->json(['error' => config('constants.login.invalid_user')]);
        } else {
            if (Hash::check($request->password, $login->password)) {

                return response()->json(['success' => config('constants.login.login_success')]);
            } else {
                return response()->json(['error' => config('constants.login.password_not_match')]);
            }
        }
    }
    public static function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response()->json('You have been Successfully logged out!');
    }
    public function login()
    {
        echo "Authoraization Error";
    }
}
