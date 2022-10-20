<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;
    public function clients(){
        return $this->hasMany(Client::class);
    }
    public function admins(){
        return $this->hasMany(Client::class);
    }
    public function employees(){
        return $this->hasMany(Client::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
    public function getType(){
        switch ($this->name) {
            case 'admin':return Admin::where('user_id', '=', $this->id)->first();
            case 'employee':return Employee::where('user_id', '=', $this->id)->first();
            case 'client':return Client::where('user_id', '=', $this->id)->first();
            default:'parece que hice cagada en algun lado che. Anda a saber donde';
        }
    }
    public function allOfSameType(){
        switch ($this->name) {
            case 'admin':return Admin::all();
            case 'employee':return Employee::all();
            case 'client':return Client::all();
            default:'parece que hice cagada en algun lado che. Anda a saber donde';
        }
    }
}
