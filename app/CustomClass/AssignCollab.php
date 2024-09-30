<?php

namespace App\CustomClass;

use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AssignCollab
{
    static public function assignCollab($id_task, $id_e)
    {
        self::deleteTeam($id_task);
        foreach ($id_e as $e) {
            DB::table('collaborators')->insert(['id_task' => $id_task, 'id_e' => $e]);
        }
        return EmployeeResource::collection(\App\Models\Employee::whereHas('tasks', function ($query) use ($id_task) {
            $query->where('collaborators.id_task', $id_task); // Specify the table name
        })->with('tasks')->get());
    }

    static public function deleteTeam($id)
    {
        DB::table('collaborators')->where('id_task', '=', $id)->delete();
    }
}
