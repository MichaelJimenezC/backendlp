<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // ID único para cada producto
            $table->string('name'); // Nombre del producto
            $table->text('description')->nullable(); // Descripción opcional
            $table->decimal('price', 8, 2); // Precio del producto
            $table->integer('stock'); // Cantidad disponible
            $table->timestamps(); // Campos de marca de tiempo
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};

