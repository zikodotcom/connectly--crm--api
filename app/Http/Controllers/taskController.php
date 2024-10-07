<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Http\Request;
use App\CustomClass\AssignCollab;
use App\Http\Requests\taskRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\CollabResources;
use App\Http\Requests\taskUpdateRequest;
use App\Http\Resources\EmployeeResource;
use App\Http\Requests\attachmentsRequest;
use App\Http\Requests\assignCollabRequest;
use App\Http\Resources\AttachmentResource;
use App\Models\Attachments;
use Illuminate\Support\Facades\Storage;

class taskController extends Controller
{
    /**
     * Update status
     */
    public function updateStatus(Request $request)
    {
        foreach ($request->data as $key => $task) {
            $taskFind = Task::find($task['id_task']);
            $taskFind->status = $request->status;
            $taskFind->priority = $key;
            $taskFind->save();
        }
        return response()->json(['message' => 'Task status updated.']);
    }
    /**
     * Assign collaborator
     */
    public function assignCoolab(assignCollabRequest $request)
    {
        $data = $request->validated();
        $collabs = AssignCollab::assignCollab($data['id_task'], $data['id_e']);
        return response()->json($collabs);
    }
    /**
     * Assign attachments
     */
    public function assignAttachment(attachmentsRequest $request)
    {
        $data = $request->validated();
        $path = "attachments";
        $file = $request->file('file');
        $fileName = $file->store('attachments', 'public');
        $attach = Attachments::create([
            'attach_name' => $fileName,
            'attach_link' => $path,
            'id_task' => $data['id_task'],
            'size' => $file->getSize()
        ]);
        return new AttachmentResource($attach);
    }
    /**
     * Delete attachments
     */
    public function deleteAttachment($id)
    {
        $attach = Attachments::find($id);
        // DELTE FILE
        if (Storage::disk('public')->exists($attach->attach_name)) {
            Storage::disk('public')->delete($attach->attach_name);
        }
        $attach->delete();
        return response('', 201);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = [];
        $status = ['Pending', 'In progress', 'In review', 'Completed'];
        foreach ($status as $statut) {
            $tasks[$statut] = Cache::tags(['tasks'])->rememberForever('task_' . $statut, function () use ($statut) {
                return Task::with(['collaborators'])->where('status', '=', $statut)->orderBy('priority', 'ASC')->get();
            });
        }
        return response()->json($tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(taskRequest $request)
    {
        $data = $request->validated();
        $data['dateS'] = Carbon::parse($data['dateS']);
        $data['dateF'] = Carbon::parse($data['dateF']);
        $data['priority'] = 1;
        $task = Task::create($data);
        return response()->json($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::with(['collaborators', 'attachments'])->find($id);
        return new TaskResource($task);
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
    public function update(taskUpdateRequest $request, string $id)
    {
        $data = $request->validated();
        if (str_contains($data['key'], 'date')) {
            $data['value'] = Carbon::parse($data['value']);
        }
        $task = Task::find($id);
        $task[$data['key']] = $data['value'];
        $task->save();
        return response('', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
