<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::oldest('id')->filter(request(['category_id', 'search']))->paginate('8');
        return view('products.index', [
            'products' => $products
        ]);
    }
    public function show(Product $product){
        return view('products.show', [
            'product'=>$product
        ]);
    }
}

