<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = ['products[]', 'quantities[]', 'date', 'user_id', 'payment_type_id', 'total'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function paymentType(){
        return $this->belongsTo(PaymentType::class);
    }
    public function details(){
        return $this->hasMany(SaleDetail::class);
    }
    public function total(){
        $total = 0;
        foreach ($this->details as $detail) {
            $subtotal = $detail->price * $detail->quantity;
            $total += $subtotal;
        };
        return $total;
    }
    //Filtrar por busqueda y por categoria
    public function scopeFilter($query, array $filters){
        
        $array = Supplier::all('name');
        //Filtra por tipo de pago
        if($filters['payment_type_id'] ?? false){
            $query->where('payment_type_id', '=', request('payment_type_id'));
        };
        // Busqueda
        if($filters['search'] ?? false){
            $clients = User::filter(request(['search']))->get();
                    if ($clients->count()) {
                        foreach ($clients as $client) {
                           
                            $query->where('user_id', '=', $client->id);
                        }
                        
                    }else {
                        $query->where('user_id', '=', $filters['search'])->orWhere('id', '=', $filters['search']);
            }
        }
    }
}
