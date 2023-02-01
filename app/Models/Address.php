<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable=['street', 'address', 'department', 'between_streets', 'zone_id', 'details'];

    public function zone(){
        return $this->belongsTo(Zone::class);
    }
    public function client(){
        return $this->hasOne(Client::class);
    }
    public function admin(){
        return $this->hasOne(Admin::class);
    }
    public function employee(){
        return $this->hasOne(Employee::class);
    }
}
