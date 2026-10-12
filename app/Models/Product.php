<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'quantity',
        'category_id',
        'status',
    ];

    //relación con category
    //un producto pertenece a una categoría
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //relación con user
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relación con images
    //un producto tiene muchas imágenes
    public function images(){
        return $this->hasMany(ProductImage::class);
    }
}
