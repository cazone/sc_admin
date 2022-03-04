<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizaciones extends Model
{
    use HasFactory;

    const COTIZACION = 'Cotización';
    CONST NOTA       = 'Nota de venta';
    protected $fillable = [
        'balance',
        'subtotal',
        'utilidad',
        'total',
        'iva',
        'estatus',
        'comentario',
        'terminos',
        'fecha',
        'cliente_id',
        'user_id',

    ];

    protected static function boot()
    {
        //funcion inseta id del usuario logeado automaticamente
        parent::boot();
        self::creating(function ($table) {
            if (!app()->runningInConsole()) {
                $table->user_id = auth()->id();
            }
        });

    }
    public function detalleCotizacion(){
        return $this->hasMany(DetalleCotizacion::class);
    }
    public function cliente(){
        return $this->belongsTo(Clientes::class);
    }
}
