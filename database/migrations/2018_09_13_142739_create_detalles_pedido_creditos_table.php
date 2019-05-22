<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesPedidoCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_pedidos_credito', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad');
            $table->float('valor_unitario',11,2);
            $table->bigInteger('producto_id')->unsigned();
            $table->integer('credito_id')->unsigned();
            $table->timestamps();

            $table->foreign('producto_id')->references('id')->on('products');
            $table->foreign('credito_id')->references('id')->on('pedidos_credito');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles_pedidos_credito');
    }
}
