<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\isNull;

class ProductController extends Controller
{
    //Mostrar todos los Productos
    public function index(){
       
        
        if (request()->input('orderBy') != ""){
            $query = request()->input('orderBy');
        }else{
            $query = 'id';
        }
            if (request()->input('order') === 'desc') {
                $products = Product::orderBy($query, 'desc')->filter(request(['category_id', 'search']))->paginate('8');
            }
            else {
                $products = Product::orderBy($query)->filter(request(['category_id', 'search']))->paginate('8');
            }
            
        
        $user = auth()->user();
        if (!is_null($user)) {
            if ($user->user_type==1){
                return view('admin.products.index', [
                    'products' => $products
                ]);
            }
        }
        return view('products.index', [
            'products' => $products
        ]);
    }
    //Mostrar un solo Producto
    public function show(Product $product){
        if (auth()->user()){
            if (auth()->user()->user_type==1) {
                return view('admin.products.show', [
                    'product' => $product
                ]);
            }
        }
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
        Product::create($formFields);
        return redirect('/');
    }
    public function filter(Request $request){
        dd($request);
    }
}

