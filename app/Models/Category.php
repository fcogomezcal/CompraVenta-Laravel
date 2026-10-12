<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
    ];

    public static $rules = [
        'name' => 'required|unique:categories|max:255',
        'description' => 'nullable|string',
    ];

    //relación 
    //una categoría tiene muchos productos
    public function products(){
        return $this->hasMany(Product::class);
    }

    
}
