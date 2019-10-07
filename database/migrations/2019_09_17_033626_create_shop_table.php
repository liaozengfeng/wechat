<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop', function (Blueprint $table) {
            $table->bigIncrements('shop_id');
            $table->timestamps();
            $table->string('shop_name', 100);
            $table->decimal('shop_price', 8, 2);
            $table->string('shop_img', 255);
            $table->string('shop_imgs', 255);
            $table->string('is_new', 4);
            $table->string('is_besc', 4);
            $table->string('is_hot', 4);
            $table->string('is_up', 4);
            $table->text('shop_desc',255);
            $table->integer('brand_id');
            $table->integer('sort_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop');
    }
}
