<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(){
        return view('admin.purchases.index', [
            'purchases' => Purchase::paginate('12')
        ]);
    }
    public function show(Purchase $purchase){
        return view('admin.purchases.show', [
            'purchase' => $purchase
        ]);
    }
    public function create(){
        return view('admin.purchases.create');
    }
    public function store(){
        
    }
}
