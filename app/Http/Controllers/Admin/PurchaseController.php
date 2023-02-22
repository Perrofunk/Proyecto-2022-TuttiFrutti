<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(){
        $orderBy = request()->input('orderBy');
        if ($orderBy != ""){
            $query = $orderBy;
        }else{
            $query = 'id';
        }
            if (!is_null(request()->input('orderDirection'))) {
                $orderDirection = request()->input('orderDirection');
            } else {$orderDirection = 'asc';}
            
            $purchases = Purchase::orderBy($query, $orderDirection)->filter(request(['supplier_id', 'search']));
                if ($purchases->doesntExist()) {
                    return redirect()->back()->withErrors('No hay datos para este proveedor ');
                } else {
                    $purchases = $purchases->paginate('12')->appends(request()->query());
                    
                }
        return view('admin.purchases.index', [
            'purchases' => $purchases
        ]);
    }
    public function create()
    {
        $purchases = Purchase::all();
        return view('admin.purchases.create', [
            'purchases' => $purchases
        ]);
    }
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'date'=>'required',
            'supplier_id'=>'required|integer',
            'detail'=>'nullable'
        ]);
        $purchase = Purchase::create([
            'date'=>$request->date,
            'supplier_id'=>$request->supplier_id,
            'total'=>'0'
        ]);
        if ($request->detail != null) {
            return redirect()->route('details.create', [$purchase]);
        }else{
        return redirect()->route('purchases.index');
        }
        // $purchaseDetails = $purchase->purchaseDetails()->create([
        //     'product_id'=>$request->product_id,
        //     'supplier_id' => $purchase->supplier_id,
        //     'quantity'=>$request->quantity,
        //     'price'=>$request->price
        // ]);
        
        // $total = $purchaseDetails->price * $purchaseDetails->quantity;
         
        // $purchase->update([
        //     'total'=>$total
        // ]);
        
        
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return view('admin.purchases.show', [
            'purchase'=>$purchase
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        return view('admin.purchases.edit', [
            'purchase' => $purchase
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        $formFields = $request->validate([
            'date'=>'date|required',
            'supplier_id'=>'integer|required',
            'detail'=>'nullable'
        ]);
        $purchase->update($formFields);
        if ($request->detail != null) {
            return redirect()->route('details.create', [$purchase]);
        }
        else{
        return redirect()->route('purchases.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->back();
    }
    
}
