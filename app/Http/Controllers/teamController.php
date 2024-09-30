<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomClass\AssignTeam;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class teamController extends Controller
{
    // TODO: Assign team
    public function assign(Request $request)
    {
        AssignTeam::assignTeam($request->id, $request->id_e);
        Cache::tags(['projects'])->flush();
        return response()->json('team assingned by success.');
    }
    // TODO: Get list team
    public function listTeam(Request $request)
    {
        $teams = DB::table('team')->where('id', '=', $request->id)->get(['id_e']);
        return response()->json($teams);
    }
}
