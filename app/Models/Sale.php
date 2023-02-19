<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function paymentType(){
        return $this->belongsTo(PaymentType::class);
    }
    public function details(){
        return $this->hasMany(SaleDetail::class);
    }
    //Filtrar por busqueda y por categoria
    public function scopeFilter($query, array $filters){
        
        $array = Supplier::all('name');
        //Filtra por tipo de pago
        if($filters['payment_type_id'] ?? false){
            $query->where('payment_type_id', '=', request('payment_type_id'));
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
        }
}
