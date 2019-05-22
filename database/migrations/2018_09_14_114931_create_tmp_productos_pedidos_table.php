<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmpProductosPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_productos_pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('producto_id')->unsigned();
            $table->float('precio',11,2);
            $table->integer('cantidad');
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('producto_id')->references('id')->on('products');
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
        Schema::dropIfExists('tmp_productos_pedidos');
    }
}
