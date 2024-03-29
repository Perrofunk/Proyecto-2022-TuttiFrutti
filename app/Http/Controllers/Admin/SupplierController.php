<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
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

        $suppliers = Supplier::orderBy($query, $orderDirection)->filter(request(['search']));
            if ($suppliers->doesntExist()) {
                $suppliers = Supplier::orderBy($query, $orderDirection)->paginate('12')->appends(request()->query());
            } else {
                $suppliers = $suppliers->paginate('12')->appends(request()->query());
            };
        
        return view('admin.suppliers.index', [
            'suppliers'=>$suppliers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('admin.suppliers.create', [
            'suppliers' => $suppliers
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
        $formFields = $request->validate([
            'name'=>'string|required',
            'email'=>'required|email',
            'contact'=>'required|string',
            'address'=>'required|string',
            'phone'=>'required'
        ]);
        $supplier = Supplier::create($formFields);
        return redirect()->route('suppliers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return view('admin.suppliers.show', [
            'supplier' => $supplier
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('admin.suppliers.edit', [
            'supplier'=>$supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $formFields = $request->validate([
            'name'=>'string|required',
            'email'=>'required|email',
            'contact'=>'required|string',
            'address'=>'required|string',
            'phone'=>'required'
        ]);
        $supplier->update($formFields);
        return redirect()->route('suppliers.index');
        // $purchase->update($formFields);
        // return redirect()->route('purchases.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->back();
    }
}
