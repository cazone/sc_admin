<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCotizacion extends Model
{
    use HasFactory;

    protected $table = 'detalle_cotizacion';

    protected $fillable = [
        'cantidad',
        'sku',
        'url_imagen',
        'descripcion',
        'utilidad',
        'precio',
        'iva',
        'isIva',
        'cotizaciones_id',
        'proveedores_id',
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
}
