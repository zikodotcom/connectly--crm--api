<?php

namespace App\Http\Controllers\project;

use Carbon\Carbon;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\projectRequest;
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
            return Project::with(['employees', 'client', 'respProject'])->orderBy('created_at', 'DESC')->paginate(10);
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
    public function store(projectRequest $request)
    {
        $data = $request->validated();
        $data['dateS'] = Carbon::parse($data['dateS']);
        $data['dateF'] = Carbon::parse($data['dateF']);
        Project::create($data);
        return response()->json(['message' => 'Project added by success.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Project::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(projectRequest $request, string $id)
    {
        $project = Project::find($id);
        $data = $request->validated();
        $data['dateS'] = Carbon::parse($data['dateS']);
        $data['dateF'] = Carbon::parse($data['dateF']);
        $project = $project->fill($data)->save();
        return response()->json(['message' => 'Project updated by success.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Project::find($id)->delete();
        return response()->json(['message' => 'Project deleted by success.']);
    }
}
