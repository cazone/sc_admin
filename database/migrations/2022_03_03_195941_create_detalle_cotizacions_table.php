<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_cotizacion', function (Blueprint $table) {
            $table->id();
            $table->string('cantidad');
            $table->string('sku');
            $table->string('url_imagen');
            $table->string('descripcion');
            $table->float('utilidad');
            $table->decimal('precio',12,2);
            $table->decimal('iva',12,2);
            $table->boolean('isIva');
            $table->bigInteger('id_cotizacion')->unsigned();
            $table->bigInteger('id_proveedor')->unsigned();
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
        Schema::dropIfExists('detalle_cotizacions');
    }
}