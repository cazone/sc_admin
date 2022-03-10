<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    CONST ALTA          = 'Alta';
    CONST REVISON       = 'En revision';
    CONST TERMINADO     = 'Terminado';
    CONST CANCELADO     = 'Cancelado';

    protected $fillable = [
        'estatus',
        'fecha_alta',
        'fecha_termino',
        'serie',
        'marca',
        'modelo',
        'tipo',
        'accesorios',
        'falla',
        'observaciones',
        'solucion',
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

    public function cliente(){
        return $this->belongsTo(Clientes::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }



}
