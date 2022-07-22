<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
            return view('welcome', [
                    'products' => Product::all(),
                    'categories'=> Category::all()
                ]);
        }
}
