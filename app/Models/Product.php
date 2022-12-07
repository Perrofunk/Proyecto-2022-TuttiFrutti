<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['name', 'description', 'category_id', 'price'];
    //relacion uno a muchos inversa
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
    public function details(){
        return $this->hasMany(PurchaseDetail::class);
    }
    
    //Aca se arma lo que laravel llama QueryScope. Es una funcion que se puede reutilizar, y se construye poniendo el prefijo "scope" a cualquier metodo del modelo, en este caso el metodo se llama "filter". Cuando se llama la funcion se lo hace con el nombre del metodo, sin el prefijo scope. Asi que si por ejemplo quiero filtrar una coleccion de datos, tendria que hacerlo asi:
    //$Coleccion->filter(request(['filtro']))->get();
    
    //Filtrar por busqueda y por categoria
    public function scopeFilter($query, array $filters){
        
        //Filtra por id de categoria, se llama cuando se apretan los botones en las vistas
        if($filters['category_id'] ?? false){
            $query->where('category_id', 'like', '%' . request('category_id') . '%');
        };
        if($filters['search'] ?? false){
            //Si la busqueda es una categoria:
            if(request('search') === "fruta" || request('search') === "verdura" || request('search') === "otro"){
                $search= Category::filter(request(['search']))->get('id');
                $search= $search[0]['id'];
            $query->where('category_id', 'like', '%' . $search . '%');
            //Si la busqueda es un nombre de producto:
            }else{
                $query->where('name', 'like', '%' . request('search') . '%'); 
            }
            }
        }
            
            // if (!$search->get()->isEmpty()){
            //     dd($search);
            // }else{
            // ;
            // }
            // $query->where('name', 'like', '%' . request('search') . '%');
        }
        
