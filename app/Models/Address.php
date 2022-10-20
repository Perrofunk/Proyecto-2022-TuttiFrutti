<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public function zone(){
        return $this->belongsTo(Zone::class);
    }
    public function client(){
        return $this->hasOne(Client::class);
    }
}
