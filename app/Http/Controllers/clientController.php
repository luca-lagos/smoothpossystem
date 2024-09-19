<?php

namespace App\Http\Controllers;

use App\Http\Requests\storePeopleRequest;
use App\Http\Requests\storePersonRequest;
use App\Http\Requests\updateClientRequest;
use App\Http\Requests\updatePeopleRequest;
use App\Models\Client;
use App\Models\Document;
use App\Models\People;
use App\Models\Person;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class clientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $clients = Client::with('people.document')->get();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documents = Document::all();
        return view('clients.create', compact('documents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storePeopleRequest $request)
    {
        DB::beginTransaction();
        try {
            $person = People::create($request->validated());
            $person->client()->create([
                'people_id' => $person->id
            ]);
            DB::commit();
        } catch (Exception $e) {
            error_log($e);
            info($e);
            DB::rollBack();
        }
        return redirect()->route('clients.index')->with('success', 'Cliente creado exitosamente :)');
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
    public function edit(Client $client)
    {
        $client->load('people.document');
        $documents = Document::all();
        return view('clients.edit', compact('client','documents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateClientRequest $request, Client $client)
    {
        //
        try {
            DB::beginTransaction();
            People::where('id', $client->people->id)->update($request->validated());
            DB::commit();
        } catch (Exception $e) {
            error_log($e);
            info($e);
            DB::rollBack();
        }
        return redirect()->route('clients.index')->with('success', 'Cliente actualizado exitosamente :)');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $person = People::find($id);
        if ($person->status == 1) {
            People::where('id', $person->id)->update([
                'status' => '0'
            ]);
        } else {
            People::where('id', $person->id)->update([
                'status' => '1'
            ]);
        }

        return redirect()->route('clients.index')->with('success', 'Estado actualizado correctamente :)');
    }
}
