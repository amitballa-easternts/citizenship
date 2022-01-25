<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use Illuminate\Http\Request;
use App\Models\MigrateList;
use App\Models\UserLogin;

class Migrate extends Controller
{
    public function migrateList()
    {
        $migrateList =   MigrateList::all();
        return response()->json(['data' => $migrateList]);
    }

    public function approvedMigrate(Request $request)
    {
        $stateWiseList =  Citizen::Where('id',  $request->session_user_id)->first();
        if (!$stateWiseList) {

            return response()->json(['error' => config('constants.state_list.not_found_user')]);
        }
        $loginCheck =   UserLogin::Where('user_id', $stateWiseList->id,)->Where('type', '1')->first();
        if (!$loginCheck) {

            return response()->json(['error' => config('constants.state_list.not_admin')]);
        }

        $migrateList =   MigrateList::where('id', '=', $request->id)->first();
        if (!$migrateList) {
            return response()->json(['error' => config('constants.migrate.id_found_user')]);
        }
        if ($migrateList->migrate_state_id != $loginCheck->state) {
            return response()->json(['error' => config('constants.migrate.not_access')]);
        }
        if ($migrateList->status == $request->status) {
            return response()->json(['error' => config('constants.migrate.allready_status')]);
        }
        $migrateList->approved_by = $loginCheck->user_id;
        $migrateList->status = $request->status;
        $migrateList->save();


        $citizen =  Citizen::Where('id', $migrateList->user_id)->first();
        $citizen->state = $migrateList->migrate_state_id;
        $citizen->save();
        return response()->json(['success' => config('constants.migrate.success')]);
    }

    public function migrateListApproved()
    {
        $migrateList =   MigrateList::where('status', '=', 'Approved')->get();

        return response()->json(['data' => $migrateList]);
    }

    public function migrateListDisapproved()
    {
        $migrateList =   MigrateList::where('status', '=', 'Disapproved')->get();

        return response()->json(['data' => $migrateList]);
    }
    public function migrateListById(Request $request, MigrateList $migrate)
    {

        $migrateList =   MigrateList::where('id', '=', $migrate->id)->first();

        return response()->json(['data' => $migrateList]);
    }
}
