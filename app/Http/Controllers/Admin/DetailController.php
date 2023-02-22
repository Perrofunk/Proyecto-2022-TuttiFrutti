<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Purchase;
use App\Http\Controllers\Controller;
use App\Models\PurchaseDetail;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Purchase $purchase)
    {
        $detail = PurchaseDetail::where('purchase_id', '=', $purchase->id)->paginate(8);
       
        if ($detail->isEmpty()) {
            
            return view('admin.purchases.details.index', [
                'purchase'=>$purchase,
                'detail'=>$detail
            ])->with('error', 'Actualmente, no existen registros.');
            
        } else {
        return view('admin.purchases.details.index', [
            'purchase'=>$purchase,
            'detail'=>$detail
        ]);}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Purchase $purchase)
    {
        $details = PurchaseDetail::all();
        return view('admin.purchases.details.create', [
            'detail' => $details,
            'purchase'=>$purchase
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Purchase $purchase)
    {
        $formFields = $request->validate([
            'product_id'=>'required|integer',
            'quantity'=>'required|integer',
            'price'=>'required|integer'
        ]);
        $purchaseDetails = $purchase->details()->create([
                'product_id'=>$request->product_id,
                'supplier_id' => $purchase->supplier_id,
                'quantity'=>$request->quantity,
                'price'=>$request->price
            ]);
        $total = 0;
        foreach ($purchase->details as $purchaseDetail) {
            $test = $purchaseDetail->price * $purchaseDetail->quantity;
            $total += $test;
        }   
            $purchase->update([
                'total'=>$total
            ]);
        
        return redirect()->route('details.index', ['purchase'=>$purchase]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase, $id)
    {
        $purchaseDetail = $purchase->details;
        foreach ($purchaseDetail as $detail) {
            if ($detail->id == $id) {
                $purchaseDetail = $detail;
            };
        }
        return view('admin.purchases.details.edit', [
            'purchase' => $purchase,
            'detail'=>$purchaseDetail
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase, $id)
    {
        $formFields = $request->validate([
            'product_id'=>'integer|required',
            'quantity'=>'integer|required',
            'price'=>'integer|required',
        ]);
        $detail = '';
        $purchaseDetails = $purchase->details;
        foreach ($purchaseDetails as $purchaseDetail) {
            if ($purchaseDetail->id == $id) {
                $detail = $purchaseDetail;
            }
        }
        $detail->update($formFields);
        $total = 0;
        foreach ($purchaseDetails as $purchaseDetail) {
            $test = $purchaseDetail->price * $purchaseDetail->quantity;
            $total += $test;
        }
            $purchase->update([
                'total'=>$total
            ]);
        
        return redirect()->route('details.index', ['purchase'=>$purchase]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase, $id)
    {
            $purchaseDetails = $purchase->details;
            foreach ($purchaseDetails as $detail) {
                if ($detail->id == $id) {
                    
                    $detail->delete();
                };
            }
        return redirect()->back();
    }
}
