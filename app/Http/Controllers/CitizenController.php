<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\UserLogin;
use App\Models\MigrateList;
use App\Http\Requests\CitizenRequest;
use Illuminate\Http\Request;
use App\Http\Resources\CitizenResource;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth;

class CitizenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  Citizen::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:50',
            'lastname' => 'required|max:50',
            'state' => 'required|max:50',
            'aadhar_card' => 'required', 'integer', 'digits:12', 'regex:/^[2-9]{1}[0-9]{3}[0-9]{4}[0-9]{4}$/i',
            'mobile_number' => 'required|integer|digits:10|starts_with:9,8,7,6',
            'email' => 'required|max:255|unique:Citizens,email,NULL,id',
            'password' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 421);
        } else {
            $citizen = new CitizenResource(Citizen::create($request->all([])));
            $lastId = $citizen->id;

            if (isset($lastId)) {
                $userLogin = new UserLogin;
                $userLogin->email = $request->email;
                $userLogin->password = Hash::make($request->password);
                $userLogin->user_id = $lastId;
                $userLogin->save();
            }
            $accessToken = $citizen->createToken('authToken')->accessToken;
            response(['user_logins' => Auth::user(), 'access_token' => $accessToken]);
            return response()->json(['success' => config('constants.success')]);
        }

        /*         $citizen = new CitizenResource(Citizen::create($request->all([])));
        $lastId = $citizen->id;

        if (isset($lastId)) {
            $userLogin = new UserLogin;
            $userLogin->email = $request->email;
            $userLogin->password = Hash::make($request->password);
            $userLogin->user_id = $lastId;
            $userLogin->save();
        }
        return response()->json(['success' => config('constants.success')]); */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Citizen  $citizen
     * @return \Illuminate\Http\Response
     */
    public function show(Citizen $citizen)
    {
        return new CitizenResource($citizen->load([]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Citizen  $citizen
     * @return \Illuminate\Http\Response
     */
    public function edit(Citizen $citizen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Citizen  $citizen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Citizen $citizen)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:50',
            'lastname' => 'required|max:50',
            'state' => 'required|max:50',
            'aadhar_card' => 'required', 'integer', 'digits:12', 'regex:/^[2-9]{1}[0-9]{3}[0-9]{4}[0-9]{4}$/i',
            'mobile_number' => 'required|integer|digits:10|starts_with:9,8,7,6',
            'email' => 'required|max:255',
            'password' => 'required|max:50',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 421);
        } else {
            $migrateStateId = $request->migrate_state_id;

            $citizen->update($request->all());
        }






        //return new CitizenResource($citizen);
        return Citizen::GetMessage($citizen, config('constants.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Citizen  $citizen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Citizen $citizen)
    {
        //
    }

    public function oneToOne()
    {
        return Citizen::find(2)->migrateDataOne;
    }

    public function oneToMany()
    {
        return Citizen::find(2)->migrateDataMany;
    }

    public function deleteCitizen(Request $request, Citizen $citizen)
    {
        return $citizen;
    }
}
