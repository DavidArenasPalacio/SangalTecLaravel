<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
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
            $table->string('Nombre_Cliente');
            $table->string('Documento_Cliente');
            $table->string('Telefono_Cliente');
            $table->string('Direccion_Cliente');
            $table->timestamps();
        });

        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('usuario_id')->constrained('users');
            $table->float('Precio_total', 11,2);
            $table->tinyInteger('Estado');
            $table->timestamps();
        });

        Schema::create('ventasdetalle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_id')->constrained('ventas');
            $table->foreignId('producto_id')->constrained('productos');
            $table->float('Precio_unitario', 11,2);
            $table->bigInteger('Cantidad');
            $table->float('Sub_total', 11,2);
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
        Schema::dropIfExists('ventas');
        Schema::dropIfExists('ventasdetalle');
    }
}