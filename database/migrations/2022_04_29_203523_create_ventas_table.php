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
            $table->string('Nombre_Cliente',50);
            $table->string('Documento_Cliente',20);
            $table->string('Telefono_Cliente',20);
            $table->string('Direccion_Cliente',55);
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