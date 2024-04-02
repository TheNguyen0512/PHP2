<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->increments('ordd_id');
            $table->unsignedInteger('ordd_orders_id');
            $table->foreign('ordd_orders_id')->references('ord_id')->on('orders');
            $table->string('ordd_product_name', 255);
            $table->float('ordd_product_price');
            $table->integer('ordd_quantity');
            $table->string('ordd_product_id', 128);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_detail');
    }
};
