<?php

namespace App\Http\Controllers\project;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Support\Facades\Cache;

class projectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = request()->get('page', 1);
        $project = Cache::tags(['projects'])->rememberForever('project_' . $page, function () {
            return Project::query()
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
                ->orderBy('project.created_at', 'DESC')
                ->paginate(10);
        });

        return response()->json($project);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
