<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Traits\LogsActivity;

class Clientes extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'empresas_id',
        'nombre',
        'apaterno',
        'amaterno',
        'nss',
        'fecha_nacimiento',
        'sexo',
        'rfc',
        'curp',
        'estado_civil',
        'tipo_identificacion',
        'folio_identificacion',
        'email',
        'telefono',
        'celular',
        'clabe',
        'calle',
        'no_exterior',
        'no_interior',
        'colonia',
        'municipio',
        'poblacion',
        'estado',
        'cp',
        'movimiento',
        'puesto',
        'num_empleado',
        'fecha_ingreso',
        'tipo_pago',
        'prestamo_autorizado',
        'cuenta',
        'sucursal',
        'centro_cibanco',
        'id_user_alta',
        'id_user_mod',
        'convenios_id'
    ];
    protected static function boot()
    {
        //funcion inseta id del usuario logeado automaticamente
        parent::boot();
        self::creating(function ($table) {
            if (!app()->runningInConsole()) {
                $table->id_user_alta = auth()->id();
            }
        });

    }
    public function convenio(){
        return $this->belongsTo(Convenio::class, 'convenios_id',  'id');
    }
    public function scopeFilter( Builder $query, array $filters) {
        if ( ! request("page")) {
            session()->put("search", $filters['search'] ?? null);

        }
        $query->when(session("search"), function ($query, $search) {
            $query->where(DB::raw( 'CONCAT(nombre, " ", apaterno, " ", amaterno)' ), 'LIKE', '%'. $search.'%')
            ->orWhere('num_empleado', 'LIKE', '%'. $search.'%');
        });
   }


}
