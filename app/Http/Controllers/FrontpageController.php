<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontpageController extends Controller
{
    public function index(){
        $products = Product::oldest('id')->filter(request(['category_id', 'search']))->paginate('8');
        $categories = Category::oldest('id')->filter(request(['search']))->paginate('4');

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
