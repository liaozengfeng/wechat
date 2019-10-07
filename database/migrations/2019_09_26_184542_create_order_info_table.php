<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_info', function (Blueprint $table) {
            $table->bigIncrements('order_id');
            $table->mediumInteger('u_id');
            $table->mediumInteger('province');
            $table->mediumInteger('city');
            $table->mediumInteger('district');
            $table->char('order_sn', 100);
            $table->char('consignee', 100);
            $table->char('address', 100);
            $table->char('zipcode', 100);
            $table->char('tel', 100);
            $table->char('mobile', 100);
            $table->char('email', 100);
            $table->char('sign_building', 100);
            $table->char('pay_name', 100);
            $table->tinyInteger('order_statuc');
            $table->tinyInteger('pay_statuc');
            $table->tinyInteger('pay_id');
            $table->tinyInteger('add_time');
            $table->tinyInteger('pay_time');
            // $table->integer('created_at',11);
            // $table->integer('updated_at',11);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_info');
    }
}
