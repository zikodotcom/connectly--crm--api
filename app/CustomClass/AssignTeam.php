<?php

namespace App\CustomClass;

use Illuminate\Support\Facades\DB;

class AssignTeam
{
    static public function assignTeam($id, $id_e)
    {
        self::deleteTeam($id_e);
        foreach ($id_e as $e) {
            DB::table('team')->insert(['id' => $id, 'id_e' => $e]);
        }
    }

    static public function deleteTeam($id_e)
    {
        foreach ($id_e as $e) {
            DB::table('team')->where('id_e', '=', $e)->delete();
        }
    }
}
