<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    //
    use HasFactory;
    
    protected $fillable = [
        'ruc',
        'name',
        'email',
        'phone',
        'address',
        'photo',
        'status',
    ];

    // un proveedor puede tener muchas compras
    public function compras(){
        return $this->hasMany(Compra::class);
    }
}
