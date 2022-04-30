<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_Proveedor');
            $table->string('Correo_Proveedor');
            $table->string('Telefono_Proveedor');
            $table->string('Direccion_Proveedor');
            $table->tinyInteger('Estado');
            $table->timestamps();
        });

        Schema::create('compra', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('proveedor_id')->constrained('proveedor');
            $table->float('Precio_total');
            $table->tinyInteger('Estado');
            $table->timestamps();
        });

        Schema::create('detallecompra', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compra_id')->constrained('users');
            $table->foreignId('producto_id')->constrained('productos');
            $table->integer('Cantidad');
            $table->float('Sub_total');
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
        Schema::dropIfExists('proveedor');
        Schema::dropIfExists('compra');
        Schema::dropIfExists('detallecompra');
    }
}
