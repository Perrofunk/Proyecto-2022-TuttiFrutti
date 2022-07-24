<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    use HasFactory;
    //relacion de uno a muchos
    public function products(){
        return $this->hasMany(Product::class);
    }
    //QueryFilter del modelo categoria, para poder usar la funcion filter() para filtrar categorias
    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false){
            $query->where('name', 'like', '%' . request('search') . '%');
        };
    }
}

