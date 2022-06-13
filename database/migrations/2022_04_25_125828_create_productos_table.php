<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_Categoria',50);
            $table->tinyInteger('Estado');
        });
        
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_Producto',50);
            $table->float('Precio_Compra');
            $table->float('Precio_Venta');
            $table->integer('Cantidad');
            $table->foreignId('categoria_id')->constrained('categoria');
            $table->tinyInteger('Estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoria');
        Schema::dropIfExists('productos');
    }
}
