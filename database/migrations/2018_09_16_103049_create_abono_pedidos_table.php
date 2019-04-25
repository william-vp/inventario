<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbonoPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abono_pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->float('valor',11,2);
            $table->integer('credito_id')->unsigned();
            $table->integer('caja_id')->unsigned();
            $table->timestamps();

            $table->foreign('credito_id')->references('id')->on('pedidos_credito');
            $table->foreign('caja_id')->references('id')->on('cajas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abono_pedidos');
    }
}
