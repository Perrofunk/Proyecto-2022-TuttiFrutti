<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'user_type',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    //relacion de uno a muchos
    public function sales(){
        return $this->hasMany(Sale::class);
    }
    
    public function userType(){
        return $this->belongsTo(UserType::class, 'user_type');
    }
    public function getType(){
        switch ($this->user_type) {
            case '1':return Admin::where('user_id', '=', $this->id)->first();
            case '2':return Employee::where('user_id', '=', $this->id)->first();
            case '3':return Client::where('user_id', '=', $this->id)->first();
            default:'parece que hice cagada en algun lado che. Anda a saber donde';
        }
    }
    public function client(){
        return $this->hasOne(Client::class);
    }
    public function employee(){
        return $this->hasOne(Employee::class);
    }
    public function admin(){
        return $this->hasOne(Admin::class);
    }
    public function scopeFilter($query, array $filters){
        
        //Filtra por id de categoria, se llama cuando se apretan los botones en las vistas
        if($filters['user_type'] ?? false){
            $query->where('user_type', '=', request('user_type'));
        };
        }
}
