<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeCategoryRequest;
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
        dd($categories);
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
        //dd($request);
        try {
            DB::beginTransaction();
            $characteristic = Characteristic::create($request->validated());
            $characteristic->category()->create(['characteristic_id' => $characteristic->id]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['message' => 'Hubo un error al intentar guardar la categoría.']);
        }
        return redirect()->route('categories')->with('success', 'Categoría creada correctamente :)');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
