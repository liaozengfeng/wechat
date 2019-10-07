<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->mediumInteger('address_id');
            $table->string('address_name', 100);
            $table->mediumInteger('u_id');
            $table->string('consignee', 100);
            $table->string('email', 100);
            $table->mediumInteger('province');
            $table->mediumInteger('city');
            $table->mediumInteger('district');
            $table->string('address', 100);
            $table->string('zipcode', 100);
            $table->string('tel', 100);
            $table->string('mobile', 100);
            $table->string('sign_building', 100);
            $table->string('best_time', 100);
            $table->integer('is_checked')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}
