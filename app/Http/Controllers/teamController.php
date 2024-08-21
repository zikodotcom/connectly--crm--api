<?php

namespace App\Http\Controllers;

use App\CustomClass\AssignTeam;
use Illuminate\Http\Request;

class teamController extends Controller
{
    // TODO: Assign team
    public function assign(Request $request)
    {
        AssignTeam::assignTeam($request->id, $request->id_e);
        return response()->json('team assingned by success.');
    }
}
