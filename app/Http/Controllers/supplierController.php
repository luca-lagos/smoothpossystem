<?php

namespace App\Http\Controllers;

use App\Http\Requests\storePeopleRequest;
use App\Http\Requests\updatePeopleRequest;
use App\Http\Requests\updateSupplierRequest;
use App\Models\Document;
use App\Models\People;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class supplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::with('people.document')->get();
        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documents = Document::all();
        return view('suppliers.create', compact('documents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storePeopleRequest $request)
    {
        DB::beginTransaction();
        try {
            $person = People::create($request->validated());
            $person->supplier()->create([
                'people_id' => $person->id
            ]);
            DB::commit();
        } catch (Exception $e) {
            error_log($e);
            info($e);
            DB::rollBack();
        }
        return redirect()->route('suppliers.index')->with('success', 'Proveedor creado exitosamente :)');
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
    public function edit(Supplier $supplier)
    {
        $supplier->load('people.document');
        $documents = Document::all();
        return view('suppliers.edit', compact('supplier','documents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateSupplierRequest $request, Supplier $supplier)
    {
        //
        try {
            DB::beginTransaction();
            People::where('id', $supplier->people->id)->update($request->validated());
            DB::commit();
        } catch (Exception $e) {
            error_log($e);
            info($e);
            DB::rollBack();
        }
        return redirect()->route('suppliers.index')->with('success', 'Proveedor actualizado exitosamente :)');
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

        return redirect()->route('suppliers.index')->with('success', 'Estado actualizado correctamente :)');
    }
}
