<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
    // public function create()
    // {
    //     $users = User::all();
    //     return view('admin.users.create', [
    //         'users' => $users
    //     ]);
    // }

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
