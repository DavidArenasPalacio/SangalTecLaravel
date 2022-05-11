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
            $table->string('Nombre_Categoria');
            $table->timestamps();
        });
        
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre_Producto');
            $table->float('Precio_Compra');
            $table->float('Precio_Venta');
            $table->integer('Cantidad');
            $table->foreignId('categoria_id')->constrained('categoria');
            $table->tinyInteger('Estado');
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
        Schema::dropIfExists('categoria');
        Schema::dropIfExists('productos');
    }
}
