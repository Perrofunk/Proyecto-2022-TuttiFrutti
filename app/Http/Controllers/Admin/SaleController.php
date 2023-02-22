<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->input('orderBy') != ""){
            $query = request()->input('orderBy');
        }else{
            $query = 'id';
        }
        if (!is_null(request()->input('orderDirection'))) {
            $orderDirection = request()->input('orderDirection');
        } else {$orderDirection = 'asc';}

        $sales = Sale::orderBy($query, $orderDirection)->filter(request(['payment_type_id', 'search']));
        if ($sales->doesntExist()) {
            return redirect()->back()->withErrors('No hay datos');
        } else {
            $sales = $sales->paginate('8')->appends(request()->query());
        }
        return view('admin.sales.index', [
            'sales'=>$sales
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.sales.create', [
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $request->validate([
            'user_id'=>'required',
            'payment_type_id'=>'required',
            'date'=>'required'
        ]);
    
        $sale = Sale::create($request->all());
        
    $products = $request->input('products', []);
    $quantities = $request->input('quantities', []);
    $total = 0;
    
    for ($product=0; $product < count($products); $product++) {
        if ($products[$product] != '') {
            $productModel = Product::where('id', '=', $products[$product])->first();
            $subtotal = $productModel->price * $quantities[$product];
            $total += $subtotal;
            SaleDetail::create(['sale_id'=>$sale->id, 'product_id'=>$products[$product], 'quantity'=>$quantities[$product], 'price'=>$productModel->price]);
        }
    }
    $sale->update(['total'=>$total]);

    return redirect()->route('sales.index');
    }


    public function clientStore(Request $request)
    {
    
        $request->validate([
            'user_id'=>'required',
            'payment_type_id'=>'required',
            'date'=>'required'
        ]);
    
    $userId = auth()->user()->id;
    $sale = Sale::create($request->all());
    $products = \Cart::session($userId)->getContent();

    $total = 0;
    foreach ($products as $product) {
        $subtotal = $product->price * $product->quantity;
        $total += $subtotal;
        SaleDetail::create([
            'sale_id'=>$sale->id,
            'product_id'=>$product->id,
            'price'=>$product->price,
            'quantity'=>$product->quantity
            ]
        );
    }
    $sale->update(['total'=>$total]);

    \Cart::session($userId)->clear();


    return redirect()->route('client.orders')->with('success', 'Pedido realizado con exito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        return view('admin.sales.show', [
            'sale' => $sale
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        return view('admin.sales.edit', [
            'sale'=>$sale,
            'products'=>Product::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'user_id'=>'required',
            'payment_type_id'=>'required',
            'date'=>'required'
        ]);
    
       
        $sale->details()->delete();
        $sale->update($request->all());
    $products = $request->input('products', []);
    $quantities = $request->input('quantities', []);
    $total = 0;
    
    for ($product=0; $product < count($products); $product++) {
        if ($products[$product] != '') {
            $productModel = Product::where('id', '=', $products[$product])->first();
            $subtotal = $productModel->price * $quantities[$product];
            $total += $subtotal;
            SaleDetail::create(['sale_id'=>$sale->id, 'product_id'=>$products[$product], 'quantity'=>$quantities[$product], 'price'=>$productModel->price]);
        }
    }
    $sale->update(['total'=>$total]);

    return redirect()->route('sales.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('sales.index');
    }
}
