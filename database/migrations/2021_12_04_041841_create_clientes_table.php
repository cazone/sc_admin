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
            $table->enum('sexo', ['F', 'M'])->nullable();
            $table->string('rfc',20)->nullable();
            $table->string('email',70)->nullable();
            $table->string('telefono',36)->nullable();
            $table->string('celular',36)->nullable();
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
