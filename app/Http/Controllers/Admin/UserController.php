<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Employee;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::filter(request(['user_type']))->paginate(6)->appends(request()->query());
        return view('admin.users.index', [
            'users' => $users
        ]);
    }
    public function show(User $user)
    {
        return view('admin.users.show', [
            'user' => $user
        ]);
    }
     public function create()
     {
        return view('admin.users.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname'=>['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'street'=>['nullable'],
            'address'=>['required'],
            'phone'=>['nullable'],
            'user_type'=>['required'],
            'department'=>['nullable'],
            'between_streets'=>['nullable'],
            'zone'=>['required', 'integer', 'max:9999'],
            'details'=>['nullable']
        ]);
        $zone = Zone::create([
            'postal_code'=>$request['zone']
        ]);
        $address = Address::create([
            'street'=>$request['street'],
            'address'=>$request['address'],
            'department'=>$request['department'],
            'between_streets'=>$request['between_streets'],
            'zone_id'=>$zone->id,
            'details'=>$request['details']
        ]);
        $user = User::create(['name' => $request['name'],
        'surname'=>$request['surname'],
        'email' => $request['email'],
        'user_type'=>$request['user_type'],
        'phone'=>$request['phone'],
        'password' => Hash::make($request['password'])]);
        
        switch ($request['user_type']) {
            case '1':
                Admin::create(['user_id'=>$user->id,
                'name'=>$user->user_type,
                'address_id'=>$address->id]);
                break;
            case '2':
                Employee::create(['user_id'=>$user->id,
                'name'=>$user->user_type,
                'address_id'=>$address->id,
                'date_of_employment'=>date('y/m/d')]);
                break;
            case '3':
                Client::create([
                'user_id'=>$user->id,
                'name'=>$user->user_type,
                'address_id'=>$address->id
            ]);
            break;
        }
        return redirect()->route('users.index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $formFields = $request->validate([
    //         'name'=>'string|required',
    //         'surname'=>'string|required',
    //         'email'=>'required|email',
    //         'address'=>'required|string',
    //         'user_type'=>'required'
    //     ]);
    //     $supplier = Supplier::create($formFields);
    //     return redirect()->route('suppliers.index');
    // }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
