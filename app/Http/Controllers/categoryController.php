<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeCategoryRequest;
use App\Http\Requests\updateCategoryRequest;
use App\Models\Category;
use App\Models\Characteristic;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('characteristic')->latest()->get();
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $characteristic = Characteristic::create($request->validated());
            $characteristic->category()->create(['characteristic_id' => $characteristic->id]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('categories.index')->with('success', 'Categoría creada correctamente :)');
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
    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateCategoryRequest $request, Category $category)
    {
        try {
            Characteristic::where('id', $category->characteristic->id)->update($request->validated());
            /*$category->characteristic->update($request->all());*/
        } catch (Exception $e) {
        }

        return redirect()->route('categories.index')->with('success', 'Categoría actualizada correctamente :)');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if ($category->characteristic->status == 1) {
            Characteristic::where('id', $category->characteristic->id)->update([
                'status' => '0'
            ]);
        } else {
            Characteristic::where('id', $category->characteristic->id)->update([
                'status' => '1'
            ]);
        }

        return redirect()->route('categories.index')->with('success', 'Estado actualizado correctamente :)');
    }
}
