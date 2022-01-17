<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    use HasFactory;
    protected $fillable = [
    'nombre_completo',
    'email',
    'telefono',
    'celular',
    'parentesco_id',
    'cliente_id'
];


public function parentesco(){
    return $this->belongsTo(Parentesco::class, 'parentesco_id',  'id');
}
}
