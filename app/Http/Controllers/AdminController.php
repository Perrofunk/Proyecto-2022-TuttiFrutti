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
            'compras' => Compra::all(),
            'detalleCompra' => DetalleCompra::all(),
            'proveedores' => Supplier::all()
        ]);
    }
    public function productsIndex(){
        return view('admin.products.index', [
            'products' => Product::all()
        ]);
    }
    public function comprasIndex(){
        return view('admin.compras.index', [
            'compras' => Compra::all(),
            'detalleCompras' => DetalleCompra::all(),
            'proveedores' => Supplier::all()
        ]);
    }
    public function comprasCreate(){
        return view('admin.compras.create');
    }
}
