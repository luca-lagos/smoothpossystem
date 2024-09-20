<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeShopRequest;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Supplier;
use App\Models\Voucher;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $suppliers = Supplier::whereHas('people', function ($query) {
            $query->where('status', 1);
        })->get();
        $vouchers = Voucher::all();
        $products = Product::where('status', 1)->get();
        return view('shops.create', compact('suppliers', 'vouchers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeShopRequest $request)
    {
        try {
            DB::beginTransaction();
            $shop = Shop::create($request->validated());
            $array_product = $request->get('array_id_product');
            $array_count = $request->get('array_count');
            $array_shop_price = $request->get('array_shop_price');
            $array_sale_price = $request->get('array_sale_price');

            $size_array = count($array_product);
            $counter = 0;
            while ($counter < $size_array) {
                $shop->products()->syncWithoutDetaching([
                    $array_product[$counter] => [
                        'count' => $array_count[$counter],
                        'shop_price' => $array_shop_price[$counter],
                        'sale_price' => $array_sale_price[$counter],
                    ]
                ]);

                $product = Product::find($array_product[$counter]);
                $actual_stock = $product->count;
                $new_stock = intval($array_count[$counter]);

                DB::table('products')->where('id', $product->id)->update([
                    'count' => $actual_stock + $new_stock,
                ]);

                $counter++;
            }
            DB::commit();
        } catch (Exception $e) {
            error_log($e);
            info($e);
            DB::rollBack();
        }

        return redirect()->route('shops.index')->with('success', 'La compra se ha realizado exitosamente :)');
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
