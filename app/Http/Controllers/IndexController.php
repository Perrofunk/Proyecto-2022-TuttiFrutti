<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function index(){
        $products = Product::oldest('id')->filter(request(['category_id', 'search']))->paginate('8');
        $categories = Category::oldest('id')->filter(request(['search']))->paginate('4');

        dd(auth()->user()->clients);
        if (auth()->user()->user_type) {
                # code...
        };
        if ($products->count()==0){ 
                return view('frontpage', [
                'error' =>'No hay resultados 😔'
                ]);
        }else{

            return view('frontpage', [
                    'products' => $products,
                    'categories'=> $categories
                ]);
        }
        }
}
