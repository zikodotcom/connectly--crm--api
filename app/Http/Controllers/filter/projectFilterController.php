<?php

namespace App\Http\Controllers\filter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Support\Facades\Cache;

class projectFilterController extends Controller
{
    public function index(Request $request)
    {
        $filterData = Cache::tags(['projectFilter'])->rememberForever('projectFilter_' . $request->column, function () use ($request) {
            // Get data
            if ($request->column == 'idC') {
                $data = Project::query()
                    ->select('client.clientName as name', 'project.idC')
                    ->join('client', 'client.idC', '=', 'project.idC')
                    ->get();
            } else {
                $data = Project::query()
                    ->select('employee.fullName as name', 'project.responsable')
                    ->join('employee', 'employee.id_e', '=', 'project.responsable')
                    ->get();
            }
            // filter citys repeated
            $data = $data->unique($request->column)->map(function ($column) use ($request) {
                return $column;
            })->values()->toArray();
            return $data;
        });
        return response()->json($filterData);
    }
    // Fiter function
    public function filter(Request $request)
    {
        $data = Project::query()
            ->select(
                'project.projectName',
                'employee.fullName',
                'employee.photo',
                'client.clientName',
                'client.image',
                'project.dateS',
                'project.dateF',
                'project.priority',
                'project.status',
                'project.id',
            )
            ->join('employee', 'employee.id_e', '=', 'project.responsable')
            ->join('client', 'client.idC', '=', 'project.idC')
            ->where(function ($query) use ($request) {
                foreach ($request->condition as $key => $value) {
                    $query->where($key, $value);
                }
            })
            ->orderBy('project.created_at', 'DESC')
            ->paginate(10);
        return response()->json($data);
    }
    // Sort function
    public function sort(Request $request)
    {
        $data = Project::query()
            ->select(
                'project.projectName',
                'employee.fullName',
                'employee.photo',
                'client.clientName',
                'client.image',
                'project.dateS',
                'project.dateF',
                'project.priority',
                'project.status',
                'project.id',
            )
            ->join('employee', 'employee.id_e', '=', 'project.responsable')
            ->join('client', 'client.idC', '=', 'project.idC')
            ->orderBy($request->column, $request->direction)
            ->paginate(10);
        return response()->json($data);
    }
    // Search function
    public function search(Request $request)
    {
        $columnsSearch = ['projectName', 'fullName', 'clientName'];
        $data = Project::query()
            ->select(
                'project.projectName',
                'employee.fullName',
                'employee.photo',
                'client.clientName',
                'client.image',
                'project.dateS',
                'project.dateF',
                'project.priority',
                'project.status',
                'project.id',
            )
            ->join('employee', 'employee.id_e', '=', 'project.responsable')
            ->join('client', 'client.idC', '=', 'project.idC')
            ->where(function ($q) use ($request, $columnsSearch) {
                foreach ($columnsSearch as $value) {
                    $q->orWhere($value, 'LIKE', '%' . $request->search . '%');
                }
            })
            ->paginate(10);
        return response()->json($data);
    }
}
