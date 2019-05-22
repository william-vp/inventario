<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad');
            $table->float('valor_unitario',11,2);
            $table->float('valor_total',11,2);
            $table->bigInteger('producto_id')->unsigned();
            $table->integer('factura_id')->unsigned();
            $table->timestamps();

            $table->foreign('producto_id')->references('id')->on('products');
            $table->foreign('factura_id')->references('id')->on('facturas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalles');
    }
}
