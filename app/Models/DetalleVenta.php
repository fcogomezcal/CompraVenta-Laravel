<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    //

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'unit_price',
        'subtotal',
    ];

    //relación con venta
    public function venta() {
        return $this->belongsTo(Venta::class,'sale_id');
    }

    //relación con producto
    public function producto() {
        return $this->belongsTo(Product::class,'product_id');
    }
}
