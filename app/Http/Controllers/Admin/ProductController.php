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

