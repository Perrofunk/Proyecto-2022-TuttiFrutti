<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index', [
            'purchases' => Purchase::all()
        ]);
    }
    public function productsIndex(){
        return view('admin.products.index', [
            'products' => Product::all()
        ]);
    }
    public function PurchasesIndex(){
        return view('admin.purchases.index', [
            'purchases' => Purchase::paginate('12')
        ]);
    }
    public function PurchasesShow(Purchase $purchase){
        return view('admin.purchases.show', [
            'purchase' => $purchase
        ]);
    }
    public function PurchasesCreate(){
        return view('admin.purchases.create');
    }
}
