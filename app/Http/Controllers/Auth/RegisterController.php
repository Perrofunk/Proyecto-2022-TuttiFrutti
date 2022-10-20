<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Client;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Zone;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'surname'=>['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'street'=>['nullable'],
            'address'=>['required'],
            'department'=>['nullable'],
            'between_streets'=>['nullable'],
            'zone'=>['required', 'integer', 'max:9999'],
            'details'=>['nullable']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $zone = Zone::create([
            'postal_code'=>$data['zone']
        ]);
        $address = Address::create([
            'street'=>$data['street'],
            'address'=>$data['address'],
            'department'=>$data['department'],
            'between_streets'=>$data['between_streets'],
            'zone_id'=>$zone->id,
            'details'=>$data['details']
        ]);
        $user = User::create(['name' => $data['name'],
        'surname'=>$data['surname'],
        'email' => $data['email'],
        'user_type'=>'3',
        'password' => Hash::make($data['password'])]);
        Client::create([
            'user_id'=>$user->id,
            'name'=>$user->user_type,
            'address_id'=>$address->id
        ]);
        return $user;
    }
}
