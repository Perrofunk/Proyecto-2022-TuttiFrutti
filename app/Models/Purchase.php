<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function purchaseDetails(){
        return $this->hasMany(PurchaseDetail::class);
    }
    //Filtrar por busqueda y por categoria
    public function scopeFilter($query, array $filters){
        $array = Supplier::all('name')->toArray();
        //Filtra por id de categoria, se llama cuando se apretan los botones en las vistas
        if($filters['supplier_id'] ?? false){
            $query->where('category_id', 'like', '%' . request('category_id') . '%');
        };
        if($filters['search'] ?? false){
            //Si la busqueda es una categoria:
            if(in_array(request('search'), $array)){
                $search= Supplier::filter(request(['search']))->get('id');
                $search= $search[0]['id'];
            $query->where('category_id', 'like', '%' . $search . '%');
            //Si la busqueda es un nombre de producto:
            }else{
                $query->where('name', 'like', '%' . request('search') . '%'); 
            }
            }
        }
}
