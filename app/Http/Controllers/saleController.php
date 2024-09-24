<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeSaleRequest;
use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Voucher;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class saleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with(['voucher', 'client.people', 'user'])->latest()->get();
        return view('sales.index', compact('sales'));
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
    public function store(storeSaleRequest $request)
    {
        dd($request->validated());
        try {
            DB::beginTransaction();
            $sale = Sale::create($request->validated());
            $array_product = $request->get('array_id_product');
            $array_count = $request->get('array_count');
            $array_sale_price = $request->get('array_sale_price');
            $array_discount = $request->get('array_discount');

            $size_array = count($array_product);
            $counter = 0;

            while ($counter < $size_array) {
                $sale->products()->syncWithoutDetaching([
                    $array_product[$counter] => [
                        'count' => $array_count[$counter],
                        'sale_price' => $array_sale_price[$counter],
                        'discount' => $array_discount[$counter],
                    ]
                ]);

                $product = Product::find($array_product[$counter]);
                $actual_stock = $product->count;
                $quantity = intval($array_count[$counter]);

                DB::table('products')->where('id', $product->id)->update([
                    'count' => $actual_stock - $quantity
                ]);

                $counter++;
            }

            DB::commit();
        } catch (Exception $e) {
            error_log($e);
            info($e);
            DB::rollBack();
        }

        return redirect()->route('sales.index')->with('success', 'La venta se ha realizado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        return view('sales.show', compact('sale'));
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
        $sale = Sale::find($id);
        if ($sale->status == 1) {
            Sale::where('id', $sale->id)->update([
                'status' => '0'
            ]);
        } else {
            Sale::where('id', $sale->id)->update([
                'status' => '1'
            ]);
        }

        return redirect()->route('sales.index')->with('success', 'Estado actualizado correctamente :)');
    }


    public function generateSalePDF(string $id)
    {
        $sale = Sale::find($id);
        $data = [
            'title' => 'Impresión de producto',
            'date' => date('m/d/Y'),
            'sale' => $sale,
        ];
        $pdf = Pdf::loadView('sales.generate-sale-pdf', $data);
        return $pdf->download('sale-voucher' . $sale->voucher_number . '.pdf');
    }
}
