<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable=['user_id', 'address_id', 'name'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function address(){
        return $this->belongsTo(Address::class);
    }
    public function userType(){
        return $this->belongsTo(UserType::class, 'name');
    }
    public function scopeFilter($query, array $filters){
    if ($filters['search']) {
        
        $query->where($this->user->name, 'like', '%' . $filters['search'] . '%');
    }
}
}
