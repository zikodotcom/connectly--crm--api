<?php

namespace App\Http\Controllers\filter;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class clientFilterController extends Controller
{
    public function index(Request $request)
    {
        $filterData = Cache::tags(['clientFilter'])->rememberForever('clientFilter_' . $request->column, function () use ($request) {
            // Get data
            $data = Client::query()->select($request->column)->get();
            // filter citys repeated
            $data = $data->unique($request->column)->map(function ($column) use ($request) {
                return $column[$request->column];
            })->values()->toArray();
            return $data;
        });
        return response()->json($filterData);
    }
    // Fiter function
    public function filter(Request $request)
    {
        // TODO: filter data
        $data = Client::query()->where(function ($query) use ($request) {
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
        $data = Client::query()->orderBy($request->column, $request->direction)->paginate(10);
        return response()->json($data);
    }
    // Search function
    public function search(Request $request)
    {
        $columnsSearch = ['clientName', 'email', 'phone', 'city', 'state', 'zipCode', 'country'];
        $data = Client::query()->where(function ($q) use ($request, $columnsSearch) {
            foreach ($columnsSearch as $value) {
                $q->orWhere($value, 'LIKE', '%' . $request->search . '%');
            }
        })->paginate();
        return response()->json($data);
    }
}
