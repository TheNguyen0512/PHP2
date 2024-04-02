<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->increments('proImg_id');
            $table->binary('proImg_img')->nullable();
            $table->integer('proImg_order')->nullable(false);
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('pro_id')->on('products');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
