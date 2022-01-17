<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',70);
            $table->string('apaterno',70);
            $table->string('amaterno',70);
            $table->string('nss',20)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('sexo', ['F', 'M'])->nullable();
            $table->string('rfc',20);
            $table->string('curp',20)->nullable();
            $table->string('estado_civil', 70)->nullable();//TODO hacer una tabla de estados civile
            $table->string('tipo_identificacion',70)->nullable();
            $table->string('folio_identificacion',70)->nullable();
            $table->string('email',70);
            $table->string('telefono',36);
            $table->string('celular',36);
            $table->string('clabe',20);
            $table->string('calle',70)->nullable();
            $table->string('no_exterior',70)->nullable();
            $table->string('no_interior',70)->nullable();
            $table->string('colonia',70)->nullable();
            $table->string('municipio',70)->nullable();
            $table->string('poblacion',70)->nullable();
            $table->string('estado',70)->nullable();
            $table->string('cp',20)->nullable();
            $table->string('movimiento',70)->nullable();//que es
            $table->string('puesto',70)->nullable();
            $table->string('num_empleado',70)->nullable();
            $table->date('fecha_ingreso');
            $table->string('tipo_pago',70)->nullable();
            $table->string('prestamo_autorizado',70)->nullable();
            $table->string('cuenta',20);
            $table->string('sucursal',50)->nullable();
            $table->string('centro_cibanco',20)->nullable();//que es
            $table->bigInteger('id_user_alta')->nullable();
            $table->bigInteger('id_user_mod')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
