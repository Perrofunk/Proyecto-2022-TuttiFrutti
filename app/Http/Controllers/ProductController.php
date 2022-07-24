<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('products.index', [
            'products' => Product::all(),
            'categories' => Category::all()
        ]);
    }
    public function show(Product $product){
        return view('products.show', [
            'product'=>$product
        ]);
    }
}

