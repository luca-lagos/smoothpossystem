<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeBrandRequest;
use App\Http\Requests\updateBrandRequest;
use App\Models\Brand;
use App\Models\Characteristic;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class brandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::with('characteristic')->latest()->get();
        return view('brands.index', ['brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeBrandRequest $request)
    {
        try {
            DB::beginTransaction();
            $characteristic = Characteristic::create($request->validated());
            $characteristic->brand()->create(['characteristic_id' => $characteristic->id]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('brands.index')->with('success', 'Marca creada correctamente :)');
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
    public function edit(Brand $brand)
    {
        return view('brands.edit', ['brand' => $brand]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateBrandRequest $request, Brand $brand)
    {
        try {
            Characteristic::where('id', $brand->characteristic->id)->update($request->validated());
            /*$Brand->characteristic->update($request->all());*/
        } catch (Exception $e) {
        }

        return redirect()->route('brands.index')->with('success', 'Marca actualizada correctamente :)');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        if ($brand->characteristic->status == 1) {
            Characteristic::where('id', $brand->characteristic->id)->update([
                'status' => '0'
            ]);
        } else {
            Characteristic::where('id', $brand->characteristic->id)->update([
                'status' => '1'
            ]);
        }

        return redirect()->route('brands.index')->with('success', 'Estado actualizado correctamente :)');
    }
}
