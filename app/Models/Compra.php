<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    //
    protected $fillable = [
        'supplier_id',
        'user_id',
        'tipodocumento_id',
        'total_cost',
        'purchase_date',
        'status',
    ];

    //relación con proveedores
    //una compra pertenece a un proveedor
    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    //relación con usuarios
    //una compra pertenece a un usuario
    public function user() {
        return $this->belongsTo(User::class);
    }

    //relación con tipodocumentos
    //una compra pertenece a un tipodocumento
    public function tipodocumento() {
        return $this->belongsTo(TipoDocumento::class);
    }

    //relación con detallecompras
    public function detalles() {
        return $this->hasMany(DetalleCompra::class);
    }
}

