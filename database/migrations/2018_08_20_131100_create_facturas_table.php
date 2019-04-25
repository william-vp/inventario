<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->text('observacion')->nullable();
            $table->integer('cliente_id');
            $table->integer('caja_id')->unsigned();
            $table->boolean('forma_pago');
            $table->float('subtotal',11,2);
            $table->integer('descuento');
            $table->integer('iva');
            $table->float('total',11,2);
            $table->timestamps();
        });
        Schema::table('facturas', function($table)
        {
            $table->foreign('caja_id')->references('id')->on('cajas')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
