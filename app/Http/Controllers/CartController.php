<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $userId = auth()->user()->id;
        $items = \Cart::session($userId)->getContent();
        
        return view('cart.index', [
            'items'=>$items
        ]);
    }
    public function checkout(){
        $userId = auth()->user()->id;
        $items = \Cart::session($userId)->getContent();
        return view('cart.checkout', [
            'items'=>$items
        ]);
    }
    public function add(Request $request)
{
    $userId = auth()->user()->id;
    $product = Product::findOrFail($request->input('product_id'));
    \Cart::session($userId)->add(array(
        'id' => $product->id,
    'name' => $product->name,
    'price' => $product->price,
    'quantity' => $request->input('quantity'),
    'attributes' => array(),
    'associatedModel' => $product)
    );
    return redirect()->back()->with('success', 'Producto añadido al carrito!');
}


    public function remove(Request $request)
    {
        \Cart::session(auth()->user()->id)->remove($request->input('product_id'));
        return redirect()->back();
    }

    public function update(Request $request)
    {
        // Update cart logic
    }
}
