<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class ProductController extends Controller
{
    //Mostrar todos los Productos
    public function index(){
       
        
        $orderBy = request()->input('orderBy');
        if ($orderBy != ""){
            $query = $orderBy;
        }else{
            $query = 'id';
        }
        if (!is_null(request()->input('orderDirection'))) {
            $orderDirection = request()->input('orderDirection');
        } else {$orderDirection = 'asc';}
        
            $products = Product::orderBy($query, $orderDirection)->filter(request(['category_id', 'search']));
                if ($products->doesntExist()) {
                    $products = Product::orderBy($query, 'desc')->paginate('12')->appends(request()->query());
                } else {
                    $products = $products->paginate('12')->appends(request()->query());
                    
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
        $products = Product::all();
        return view('admin.products.create', [
            'products' => $products
        ]);
    }
    //Guarda datos de Creacion
    public function store(Request $request){
        
        $formFields = $request->validate([
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
            'category_id'=>'required'
        ]);
        
        $product = Product::create($formFields);
        
        if ($request->image) {
            $url = 'storage/' . Storage::disk('public')->put('imagenes', $request->image);
            
            // $url = Storage::url('imagenes/');
            $product->image()->create([
                'url'=>$url
            ]);
        }
        
        return redirect()->route('products.index');
    }
    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product' => $product
        ]);
    }
    public function update(Request $request, Product $product)
    {
        $formFields = $request->validate([
            'name'=>'required',
            'description'=>'required',
            'price'=>'required',
            'category_id'=>'required'
        ]);
        
        $product->update($formFields);
        if ($request->image) {
            $url = 'storage/' . Storage::disk('public')->put('imagenes', $request->image);
            // $url = Storage::url('imagenes/');
            $product->image->update([
                'url'=>$url
            ]);
        }
        return redirect()->route('products.index');
    }
    public function destroy(Product $product)
    {
        $res = $product->delete();
        if ($res === true) {
            $imagen = $product->image;
            $imagen->delete();
        }
        return redirect()->back();
    }
    public function filter(Request $request){
        dd($request);
    }
}

