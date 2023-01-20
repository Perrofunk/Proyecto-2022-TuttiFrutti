<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    public function index(){
        
        return view('admin.index', [
            'purchases' => Purchase::all()
        ]);
    }
    public function profile(){
        $user = auth()->user();
        return view('admin.profile.index', [
            'admin' => $user
        ]);
    }
    public function settings(){
        $user = auth()->user();
        return view('admin.profile.settings', [
            'admin' => $user
        ]);
    }
    // public function productsindex(){
    //     return view('admin.products.index', [
    //         'products' => Product::all()
    //     ]);
    // }
    
    public function pages(){
        return view('admin.pages');
    }
}
