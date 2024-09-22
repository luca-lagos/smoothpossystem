<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class saleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subquery = DB::table('product_shop')->select('product_id', DB::raw('MAX(created_at) AS max_created_at'))->groupBy('product_id');

        $products = Product::join('product_shop AS ps', function ($join) use ($subquery) {
            $join->on('ps.product_id', '=', 'products.id')->whereIn('ps.created_at', function ($query) use ($subquery) {
                $query->select('max_created_at')->fromSub($subquery, 'subquery')->whereRaw('subquery.product_id = ps.product_id');
            });
        })->select('products.id', 'products.code', 'products.name', 'products.count AS stock', 'ps.sale_price')->where('products.status', 1)->where('products.count', '>', '0')->get();
        
        $clients = Client::whereHas('people', function ($query) {
            $query->where('status', 1);
        })->get();
        $vouchers = Voucher::all();
        /*$products = Product::where('status', 1)->get();*/
        return view('sales.create', compact('clients', 'vouchers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
