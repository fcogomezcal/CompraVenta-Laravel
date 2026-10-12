<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
    protected $fillable = [
        'customer_id',
        'user_id',
        'tipodocumento_id',
        'total_price',
        'sale_date',
        'status',
        'payment_method',
    ];

    //relación con clientes
    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    //relación con usuarios
    public function user() {
        return $this->belongsTo(User::class);
    }

    //relación con tipodocumentos
    public function tipodocumento() {
        return $this->belongsTo(TipoDocumento::class);
    }

    //relación con detallecompras
    public function detalles() {
        return $this->hasMany(DetalleVenta::class);
    }

}
