<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserLogin;

class Administrator extends Controller
{
    public function addAdministrator(Request $request)
    {
        $userLogin =  UserLogin::where('user_id', '=', $request->user_id)->first();
        $userLogin->state = $request->state;
        $userLogin->type = $request->type;
        $userLogin->save();
        return response()->json(['success' => config('constants.success_admin')]);
    }

    public function getAdministrator()
    {
        $userLogin = UserLogin::where('type', '=', '1')->get();


        return response()->json(['data' => $userLogin]);
    }

    public function updateAdministrator(Request $request)
    {
        $userLogin =  UserLogin::where('user_id', '=', $request->user_id)->first();
        $userLogin->state = $request->state;
        $userLogin->type = $request->type;
        $userLogin->save();
        return response()->json(['success' => config('constants.success_admin_update')]);
    }
}
