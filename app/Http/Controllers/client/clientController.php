<?php

namespace App\Http\Controllers\client;

use App\Events\clientDeleteCache;
use App\Http\Controllers\Controller;
use App\Http\Requests\clientRequest;
use App\Http\Requests\clientRequestUpdate;
use App\Models\Client;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class clientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = request()->get('page', 1);
        $client = Cache::tags(['clients'])->rememberForever('client_' . $page, function () {
            return Client::query()->orderBy('created_at', 'DESC')->paginate(10);
        });

        return response()->json($client);
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
    public function store(clientRequest $request)
    {
        $data = $request->validated();
        $data['image'] = Storage::put('clientPicture', $data['image']);
        Client::create($data);
        return response()->json(['message' => 'Client add by success.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Client::find($id));
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
    public function update(clientRequestUpdate $request, string $id)
    {
        $client = Client::find($id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            Storage::delete([$client->image]);
            $data['image'] = Storage::put('clientPicture', $data['image']);
        }
        $client->fill($data)->save();
        return response()->json(['message' => 'Client updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::find($id);
        Storage::delete([$client->image]);
        $client->delete();
        return response()->json(['message' => 'Client deleted by success']);
    }
}
