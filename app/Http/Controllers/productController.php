<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeProductRequest;
use App\Http\Requests\updateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Presentation;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class productController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['categories.characteristic', 'brand.characteristic', 'presentation.characteristic'])->latest()->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::join('characteristics as c', 'categories.characteristic_id', '=', 'c.id')->select('categories.id as id', 'c.name as name')->where('c.status', 1)->get();
        $brands = Brand::join('characteristics as c', 'brands.characteristic_id', '=', 'c.id')->select('brands.id as id', 'c.name as name')->where('c.status', 1)->get();
        $presentations = Presentation::join('characteristics as c', 'presentations.characteristic_id', '=', 'c.id')->select('presentations.id as id', 'c.name as name')->where('c.status', 1)->get();
        return view('products.create', compact('categories', 'brands', 'presentations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $product = new Product();
            if ($request->hasFile('image_path')) {
                $name = $product->handleUploadImage($request->file('image_path'));
            } else {
                $name = null;
            }
            $product->fill([
                'code' => $request->code,
                'name' => $request->name,
                'price' => $request->price,
                'count' => $request->count,
                'description' => $request->description,
                'expiration_date' => $request->expiration_date,
                'image_path' => $name,
                'brand_id' => $request->brand_id,
                'presentation_id' => $request->presentation_id,

            ]);
            $product->save();
            $categories = $request->get('categories');
            $product->categories()->attach($categories);
            DB::commit();
        } catch (Exception $e) {
            error_log($e);
            DB::rollBack();
        }
        return redirect()->route('products.index')->with('success', 'Producto creado correctamente :)');
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
    public function edit(Product $product)
    {
        $categories = Category::join('characteristics as c', 'categories.characteristic_id', '=', 'c.id')->select('categories.id as id', 'c.name as name')->where('c.status', 1)->get();
        $brands = Brand::join('characteristics as c', 'brands.characteristic_id', '=', 'c.id')->select('brands.id as id', 'c.name as name')->where('c.status', 1)->get();
        $presentations = Presentation::join('characteristics as c', 'presentations.characteristic_id', '=', 'c.id')->select('presentations.id as id', 'c.name as name')->where('c.status', 1)->get();
        return view('products.edit', compact('product', 'categories', 'brands', 'presentations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateProductRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
            if ($request->hasFile('image_path')) {
                $name = $product->handleUploadImage($request->file('image_path'));
                if (Storage::disk('public')->exists('products/' . $product->image_path)) {
                    Storage::disk('public')->delete('products/' . $product->image_path);
                }
            } else {
                $name = $product->image_path;
            }
            $product->fill([
                'code' => $request->code,
                'name' => $request->name,
                'price' => $request->price,
                'count' => $request->count,
                'description' => $request->description,
                'expiration_date' => $request->expiration_date,
                'image_path' => $name,
                'brand_id' => $request->brand_id,
                'presentation_id' => $request->presentation_id,

            ]);
            $product->save();
            $categories = $request->get('categories');
            $product->categories()->sync($categories);
            DB::commit();
        } catch (Exception $e) {
            error_log($e);
            DB::rollBack();
        }
        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente :)');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product->status == 1) {
            Product::where('id', $product->id)->update([
                'status' => '0'
            ]);
        } else {
            Product::where('id', $product->id)->update([
                'status' => '1'
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Estado actualizado correctamente :)');
    }
}
