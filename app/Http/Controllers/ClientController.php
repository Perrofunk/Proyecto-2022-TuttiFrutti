<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Sale;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function orders(){
        $user = auth()->user();
        $orders = Sale::where('user_id', '=', $user->id)->latest()->paginate(4);
        return view('client.orders', [
            'orders' => $orders
        ]);
    }
    public function profile(){
        return view('client.profile', [
            'user'=>auth()->user()
        ]);
    }
    public function edit(){
        return view('client.edit', [
            'user'=>auth()->user()
        ]);
    }
    public function showOrder(Sale $sale){
   
        return view('client.showOrder', [
            'order'=>$sale
        ]);
    }
    public function update(Request $request){
        
        $request->validate([
        'user_type'=>['required'],
        'name' => ['required', 'string', 'max:255'],
        'surname'=>['required', 'string', 'max:255'],
        'phone'=>['nullable'],
        'old_password' => 'required',
        'new_password' => 'required|confirmed',
        'street'=>['nullable'],
        'address'=>['required'],
        'department'=>['nullable'],
        'zone'=>['required', 'integer', 'max:9999'],
        'details'=>['nullable'],
        'between_streets'=>['nullable'],
        ]);
        
        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "La contraseña anterior no es correcta");
        }
       
        $zone = Zone::firstOrCreate([
            'postal_code'=>$request['zone']
        ]);  
        #Update the new Password
        $user = User::whereId(auth()->user()->id);
        $user->update([
            'name'=>$request['name'],
            'surname'=>$request['surname'],
            'user_type'=>$request['user_type'],
            'phone'=>$request['phone'],
            'password' => Hash::make($request->new_password)
        ]);
        $address = Address::where('id', $user->first()->client->address->id);
        $address->update([
            'street'=>$request['street'],
            'address'=>$request['address'],
            'department'=>$request['department'],
            'between_streets'=>$request['between_streets'],
            'zone_id'=>$zone->id,
            'details'=>$request['details']
        ]);

        return redirect()->route('client.profile')->with("status", "Perfil actualizado correctamente");
    }
}
