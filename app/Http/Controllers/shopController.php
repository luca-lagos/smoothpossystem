<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeShopRequest;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Voucher;
use Illuminate\Http\Request;

class shopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('shops.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $vouchers = Voucher::all();
        $products = Product::all();
        return view('shops.create', compact('suppliers','vouchers','products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeShopRequest $request)
    {
        dd($request);
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
