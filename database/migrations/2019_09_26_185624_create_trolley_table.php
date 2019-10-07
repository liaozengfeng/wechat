<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrolleyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trolley', function (Blueprint $table) {
            $table->bigIncrements('t_id');
            $table->decimal('shop_price', 8, 2);
            $table->integer('shop_id');
            $table->integer('u_id');
            $table->integer('add_time');
            $table->integer('update_time'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trolley');
    }
}
