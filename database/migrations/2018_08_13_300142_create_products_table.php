<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('codigo');
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->float('precio_compra', 11,2);
            $table->float('precio_venta', 11,2);
            $table->integer('bodega_id')->unsigned();
            $table->integer('mostrador')->nullable();
            $table->integer('existencias')->nullable();
            $table->date('vencimiento')->nullable();
            $table->integer('categoria_id')->unsigned();
            $table->integer('medida_id')->unsigned();
            $table->boolean('estado');
            $table->string('imagen',255)->default('product.png');
            $table->timestamps();

            $table->foreign('bodega_id')->references('id')->on('bodegas');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('medida_id')->references('id')->on('unidad_medida');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
