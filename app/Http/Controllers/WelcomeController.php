<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $products = Product::oldest('id')->filter(request(['category_id', 'search']))->get();
        $categories = Category::oldest('id')->filter(request(['search']))->get();

        if ($products->count()==0){ 
        return view('welcome', [
                'error' =>'No hay resultados 😔'
        ]);
        }else{
            return view('welcome', [
                    'products' => $products,
                    'categories'=> $categories
                ]);
        }
        }
}
