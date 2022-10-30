<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public function purchases(){
        return $this->hasMany(Purchase::class, 'supplier_id');
    }
    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false){
            $query->where('name', 'like', '%' . request('search') . '%');
        };
    }
}
