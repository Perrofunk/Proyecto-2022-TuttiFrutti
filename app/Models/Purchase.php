<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'total', 'supplier_id' ];
    public $availableFilters = ['id', 'date', 'total', 'supplier_id', 'supplier_name'];

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function details(){
        return $this->hasMany(PurchaseDetail::class);
    }
    //Filtrar por busqueda y por categoria
    public function scopeFilter($query, array $filters){
        
        $array = Supplier::all('name');
        //Filtra por id de categoria, se llama cuando se apretan los botones en las vistas
        if($filters['supplier_id'] ?? false){
            $query->where('supplier_id', 'like', '%' . request('supplier_id') . '%');
        };
        if($filters['search'] ?? false){
            //Si la busqueda es una categoria:
                    $search = Supplier::filter(request(['search']))->get('id');
                    if ($search->count()) {
                        $search = $search[0]['id'];
                        $query->where('supplier_id', 'like', '%' . $search . '%');
                        
                    }else {
                        $search = $query->where('id', '=', $filters['search'])->orWhere('total', 'like', '%' . $filters['search'] . '%')->orWhere('date', 'like', '%' . $filters['search'] . '%');
                    };
            }
            //Si la busqueda es un nombre de producto:
            // }else{
            //     $query->where('name', 'like', '%' . request('search') . '%'); 
                
            
        }
        public function scopeTest($query, array $filters){
            ;
        }
}
