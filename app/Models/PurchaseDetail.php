<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;
    public function purchase(){
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
