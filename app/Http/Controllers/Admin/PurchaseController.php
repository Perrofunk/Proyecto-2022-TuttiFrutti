<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(){
        // $purchases = 
        if (request()->input('orderBy') != ""){
            $query = request()->input('orderBy');
        }else{
            $query = 'id';
        }
            if (request()->input('order') === 'desc') {
                $purchases = Purchase::orderBy($query, 'desc')->filter(request(['supplier_id', 'search']))->paginate('12');
            }
            else {
                $purchases = Purchase::orderBy($query)->filter(request(['supplier_id', 'search']))->paginate('12');
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
        //
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
    public function update(Request $request, $id)
    {
        //
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
    }
}
