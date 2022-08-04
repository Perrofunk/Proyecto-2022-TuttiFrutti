<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //Mostrar todos los Productos
    public function index(){
        $products = Product::oldest('id')->filter(request(['category_id', 'search']))->paginate('8');
        return view('products.index', [
            'products' => $products
        ]);
    }
    //Mostrar un solo Producto
    public function show(Product $product){
        return view('products.show', [
            'product'=>$product
        ]);
    }
    //Mostrar Creacion de Producto
    public function create(){
        return view('admin.products.create');
    }
    //Guarda datos de Creacion
    public function store(Request $request){
        $formFields = $request->validate([
            'name'=>'required',
            'category_id'=>'required'
        ]);
        Product::factory()->create($formFields);
        return redirect('/');
    }
}

