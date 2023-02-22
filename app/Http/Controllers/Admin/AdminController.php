<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    public function index(){
        
        return view('admin.index', [
            'purchases' => Purchase::all()
        ]);
    }
    public function profile(){
        $user = auth()->user();
        return view('admin.profile.index', [
            'admin' => $user
        ]);
    }
    public function changePassword(User $user){
        
        return view('admin.profile.change-password', [
            'admin' => $user
        ]);
    }
    public function updatePassword(User $user, Request $request){
        
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "La contraseña anterior no es correcta");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Contraseña actualizada correctamente");
    }
    // public function productsindex(){
    //     return view('admin.products.index', [
    //         'products' => Product::all()
    //     ]);
    // }
    
    public function pages(){
        return view('admin.pages');
    }
}
