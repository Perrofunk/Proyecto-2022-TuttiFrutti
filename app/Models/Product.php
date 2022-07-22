<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    //relacion uno a muchos inversa
    public function category(){
        return $this->belongsTo(Category::class);
     }
}