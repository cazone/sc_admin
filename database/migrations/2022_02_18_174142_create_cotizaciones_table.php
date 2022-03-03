<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->decimal('balance',12,2);
            $table->decimal('subtotal',12,2);
            $table->decimal('utilidad',12,2);
            $table->decimal('total',12,2);
            $table->decimal('iva',12,2);
            $table->string('estatus',30);
            $table->text('comentario');
            $table->text('terminos');
            $table->date('fecha');
            $table->foreignId('cliente_id')->constrained();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('cotizaciones');
    }
}
