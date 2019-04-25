<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('fecha');
            $table->text('observacion')->nullable();
            $table->integer('proveedor_id');
            $table->integer('user_id')->unsigned();
            $table->boolean('forma_pago');
            $table->float('subtotal',11,2);
            $table->integer('descuento');
            $table->integer('iva');
            $table->float('total',11,2);
            $table->boolean('estado_pedido');
            $table->timestamps();
        });
        Schema::table('pedidos', function($table)
        {
            $table->foreign('proveedor_id')->references('id')->on('proveedores');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
