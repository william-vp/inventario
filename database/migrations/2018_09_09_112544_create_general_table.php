<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->text('logo');
            $table->text('portada');
            $table->string('email');
            $table->string('telefono');
            $table->dateTime('start_subscription');
            $table->dateTime('end_subscription');
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
        Schema::dropIfExists('general');
    }
}
