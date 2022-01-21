<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MigrateList;

class Migrate extends Controller
{
    public function migrateList()
    {
        $migrateList =   MigrateList::all();
        return response()->json(['data' => $migrateList]);
    }

    public function approvedMigrate(Request $request)
    {

        $migrateList =   MigrateList::where('id', '=', $request->id)->first();
        $migrateList->status = $request->status;
        $migrateList->save();

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
