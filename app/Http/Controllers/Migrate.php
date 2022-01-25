<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use Illuminate\Http\Request;
use App\Models\MigrateList;
use App\Models\UserLogin;
use Validator;

class Migrate extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MigrateList  
     * @return \Illuminate\Http\Response
     */

    public function migrateList()
    {
        $migrateList =   MigrateList::all();
        return response()->json(['data' => $migrateList]);
    }

    /**
     * Approved Request Migrate.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function approvedMigrate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|max:50',
            'status' => 'required|max:50',
            'session_user_id' => 'required|max:50',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 421);
        } else {
            //check User Is is Valid
            $stateWiseList =  Citizen::Where('id',  $request->session_user_id)->first();
            if (!$stateWiseList) {

                return response()->json(['error' => config('constants.state_list.not_found_user')]);
            }
            //Check User Is admin (Type  1 is admin)
            $loginCheck =   UserLogin::Where('user_id', $stateWiseList->id,)->Where('type', '1')->first();
            if (!$loginCheck) {

                return response()->json(['error' => config('constants.state_list.not_admin')]);
            }
            //list migrate
            $migrateList =   MigrateList::where('id', '=', $request->id)->first();
            if (!$migrateList) {
                return response()->json(['error' => config('constants.migrate.id_found_user')]);
            }
            if ($migrateList->migrate_state_id != $loginCheck->state) {
                return response()->json(['error' => config('constants.migrate.not_access')]);
            }
            if ($migrateList->status == $request->status) {
                return response()->json(['message' => config('constants.migrate.allready_status')]);
            }
            $migrateList->approved_by = $loginCheck->user_id;
            $migrateList->status = $request->status;
            $migrateList->save();


            $citizen =  Citizen::Where('id', $migrateList->user_id)->first();
            $citizen->state = $migrateList->migrate_state_id;
            $citizen->save();
            return response()->json(['success' => config('constants.migrate.success')]);
        }
    }

    /**
     * Display Appreved Migrate.
     *
     * @param  \Illuminate\Http\MigrateList  
     * @return \Illuminate\Http\Response
     */
    public function migrateListApproved()
    {
        $migrateList =   MigrateList::where('status', '=', 'Approved')->get();

        return response()->json(['data' => $migrateList]);
    }
    /**
     * Display Disappreved Migrate.
     *
     * @param  \Illuminate\Http\MigrateList  
     * @return \Illuminate\Http\Response
     */
    public function migrateListDisapproved()
    {
        $migrateList =   MigrateList::where('status', '=', 'Disapproved')->get();

        return response()->json(['data' => $migrateList]);
    }
    /**
     * Display Migration List By Id.
     *
     * @param  \Illuminate\Http\MigrateList  $migrate
     * @return \Illuminate\Http\Response
     */
    public function migrateListById(Request $request, MigrateList $migrate)
    {


        $migrateList =   MigrateList::where('id', '=', $migrate->id)->first();

        return response()->json(['data' => $migrateList]);
    }
}
