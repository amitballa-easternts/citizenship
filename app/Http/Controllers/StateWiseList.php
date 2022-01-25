<?php

namespace App\Http\Controllers;

use App\Http\Middleware\loginCheck;
use App\Models\Citizen;
use App\Models\MigrateList;
use App\Models\UserLogin;
use Illuminate\Http\Request;

class StateWiseList extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function stateWiseList(Request $request)
    {
        //return $request->id;
        $stateWiseList =  Citizen::Where('id',  $request->session_user_id)->first();
        if (!$stateWiseList) {

            return response()->json(['error' => config('constants.state_list.not_found_user')]);
        }
        $loginCheck =  UserLogin::Where('user_id', $stateWiseList->id,)->Where('type', '1')->first();
        if (!$loginCheck) {

            return response()->json(['error' => config('constants.state_list.not_admin')]);
        }
        $stateUser = Citizen::Where('state', $loginCheck->state)->get();

        return $stateUser;
    }

    public function userMigrate(Request $request)
    {


        if (isset($request->user_id)) {

            $migrateList = new MigrateList;
            $migrateList->migrate_state_id = $request->migrate_state_id;
            $migrateList->user_id = $request->user_id;
            $migrateList->save();

            return response()->json(['success' => config('constants.migrate.success')]);
        }
    }
}
