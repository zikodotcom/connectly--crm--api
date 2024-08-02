<?php

namespace App\Http\Controllers;

use App\Http\Requests\employeeRequest;
use App\Http\Requests\employeeRequestUpdate;
use App\Models\Employee;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class employeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Employee::query()->orderBy('created_at', 'DESC')->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(employeeRequest $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(employeeRequest $request)
    {
        $validated = $request->validated();
        $image = Storage::put('employeePicture', $validated['photo']);
        $validated['photo'] = $image;
        $data = Employee::create($validated);

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Employee::find($id));
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
    public function update(employeeRequestUpdate $request, string $id)
    {
        $data = $request->validated();
        $employee = Employee::find($id);
        // TODO: 1 -- Check if there is file
        if ($request->hasFile('photo')) {
            // TODO: 2 -- Delete the old picture
            Storage::delete([$employee->photo]);
            // TODO: 3 -- Add new picture
            $data['photo'] = Storage::put('employeePicture', $request->photo);
        }
        $data = $employee->fill($data)->save();
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        Storage::delete([$employee->photo]);
        $employee->delete();
        return response()->json(['message' => 'Employee deleted by success']);
    }
}
