<?php

namespace App\Http\Controllers;

use App\Http\Requests\storePresentationRequest;
use App\Http\Requests\updatePresentationRequest;
use App\Models\Characteristic;
use App\Models\Presentation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class presentationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presentations = Presentation::with('characteristic')->latest()->get();
        return view('presentations.index', ['presentations' => $presentations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('presentations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storePresentationRequest $request)
    {
        try {
            DB::beginTransaction();
            $characteristic = Characteristic::create($request->validated());
            $characteristic->presentation()->create(['characteristic_id' => $characteristic->id]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('presentations.index')->with('success', 'Presentación creada correctamente :)');
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
    public function edit(Presentation $presentation)
    {
        return view('presentations.edit', ['presentation' => $presentation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updatePresentationRequest $request, Presentation $presentation)
    {
        try {
            Characteristic::where('id', $presentation->characteristic->id)->update($request->validated());
            /*$category->characteristic->update($request->all());*/
        } catch (Exception $e) {
        }

        return redirect()->route('presentations.index')->with('success', 'Presentación actualizada correctamente :)');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $presentation = Presentation::find($id);
        if ($presentation->characteristic->status == 1) {
            Characteristic::where('id', $presentation->characteristic->id)->update([
                'status' => '0'
            ]);
        } else {
            Characteristic::where('id', $presentation->characteristic->id)->update([
                'status' => '1'
            ]);
        }

        return redirect()->route('presentations.index')->with('success', 'Estado actualizado correctamente :)');
    }
}
