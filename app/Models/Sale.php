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
}
