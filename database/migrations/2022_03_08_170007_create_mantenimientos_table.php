<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMantenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->string('estatus',30);
            $table->date('fecha_alta')->nullable();
            $table->date('fecha_termino')->nullable();
            $table->string('serie');
            $table->string('marca');
            $table->string('modelo');
            $table->string('tipo')->nullable();
            $table->text('accesorios')->nullable();
            $table->text('falla')->nullable();
            $table->text('observaciones')->nullable();
            $table->text('solucion')->nullable();
            $table->foreignId('cliente_id')->constrained();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('mantenimientos');
    }
}
