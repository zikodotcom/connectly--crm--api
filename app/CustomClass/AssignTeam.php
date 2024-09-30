<?php

namespace App\CustomClass;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AssignTeam
{
    static public function assignTeam($id, $id_e)
    {
        self::deleteTeam($id);
        foreach ($id_e as $e) {
            DB::table('team')->insert(['id' => $id, 'id_e' => $e]);
        }
    }

    static public function deleteTeam($id)
    {
        DB::table('team')->where('id', '=', $id)->delete();
    }
}
