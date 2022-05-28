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
            $table->string('Nombre_Proveedor', 30);
            $table->string('Correo_Proveedor', 70);
            $table->string('Telefono_Proveedor', 20);
            $table->string('Direccion_Proveedor', 55);
            $table->tinyInteger('Estado');
            $table->timestamps();
        });

        Schema::create('compra', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users');
            $table->foreignId('proveedor_id')->constrained('proveedor');
            $table->double('Precio_total');
            $table->tinyInteger('Estado');
            $table->timestamps();
        });

        Schema::create('detallecompra', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compra_id')->constrained('compra');
            $table->foreignId('producto_id')->constrained('productos');
            $table->double('Precio_unitario');
            $table->bigInteger('Cantidad');
            $table->double('Sub_total');
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
