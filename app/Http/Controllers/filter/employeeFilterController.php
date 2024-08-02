<?php

namespace App\Http\Controllers\filter;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class employeeFilterController extends Controller
{
    public function index(Request $request)
    {
        // Get data
        $data = Employee::query()->select($request->column)->get();
        // filter citys repeated
        $data = $data->unique($request->column)->map(function ($column) use ($request) {
            return $column[$request->column];
        })->values()->toArray();
        return response()->json($data);
    }
    // Fiter function
    public function filter(Request $request)
    {
        // TODO: filter data
        $data = Employee::query()->where(function ($query) use ($request) {
            foreach ($request->condition as $key => $value) {
                if ($key == 'country') {
                    $query->where($key, $value['name']);
                } else {
                    $query->where($key, $value);
                }
            }
        })->paginate(20);
        return response()->json($data);
    }
    // Sort function
    public function sort(Request $request)
    {
        $data = Employee::query()->orderBy($request->column, $request->direction)->paginate(10);
        return response()->json($data);
    }
    // Search function
    public function search(Request $request)
    {
        $columnsSearch = ['fullName', 'email', 'phone', 'city', 'state', 'zipCode', 'country', 'role'];
        $data = Employee::query()->where(function ($q) use ($request, $columnsSearch) {
            foreach ($columnsSearch as $value) {
                $q->orWhere($value, 'LIKE', '%' . $request->search . '%');
            }
        })->paginate();
        return response()->json($data);
    }
}
