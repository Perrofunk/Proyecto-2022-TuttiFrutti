<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('products', [
            'products' => Product::all(),
            'categories' => Category::all()
        ]);
    }
    public function show(Product $product){
        return view('product', [
            'product'=>$product
        ]);
    }
}

