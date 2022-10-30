<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
        public function index(){
                $auth = auth()->user();
        if ($auth){
                if ($auth->user_type==1) {
                        return redirect('admin');
                }
        }
        $products = Product::oldest('id')->filter(request(['category_id', 'search']))->take(6)->get();
        $categories = Category::oldest('id')->filter(request(['search']))->get();

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
