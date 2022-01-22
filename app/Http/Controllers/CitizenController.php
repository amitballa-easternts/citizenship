<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\UserLogin;
use App\Models\MigrateList;
use App\Http\Requests\CitizenRequest;
use Illuminate\Http\Request;
use App\Http\Resources\CitizenResource;
use Illuminate\Support\Facades\Hash;

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
    public function store(CitizenRequest $request)
    {


        $citizen = new CitizenResource(Citizen::create($request->all([])));
        $lastId = $citizen->id;

        if (isset($lastId)) {
            $userLogin = new UserLogin;
            $userLogin->email = $request->email;
            $userLogin->password = Hash::make($request->password);
            $userLogin->user_id = $lastId;
            $userLogin->save();
        }
        return response()->json(['success' => config('constants.success')]);
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
    public function update(CitizenRequest $request, Citizen $citizen)
    {
        $migrateStateId = $request->migrate_state_id;

        $citizen->update($request->all());


        if (isset($migrateStateId)) {

            $migrateList = new MigrateList;
            $migrateList->migrate_state_id = $request->migrate_state_id;
            $migrateList->user_id = $citizen->id;
            $migrateList->save();
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
}
