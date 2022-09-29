<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index', [
            'compras' => Compra::all()
        ]);
    }
    public function productsIndex(){
        return view('admin.products.index', [
            'products' => Product::all()
        ]);
    }
    public function comprasIndex(){
        return view('admin.compras.index', [
            'compras' => Compra::paginate('12')
        ]);
    }
    public function comprasShow(Compra $compra){
        return view('admin.compras.show', [
            'compra' => $compra
        ]);
    }
    public function comprasCreate(){
        return view('admin.compras.create');
    }
}
