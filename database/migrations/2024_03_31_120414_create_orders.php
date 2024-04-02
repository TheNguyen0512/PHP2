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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('ord_id');
            $table->unsignedInteger('user_id')->nullable(true);
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('ord_user_name');
            $table->string('ord_Dob', 20)->nullable();
            $table->string('ord_address', 150)->nullable();
            $table->string('ord_phone_no', 15);
            $table->string('ord_pay_status', 50);
            $table->string('ord_payment', 50);
            $table->string('ord_status', 50);
            $table->text('ord_note')->nullable();
            $table->float('ord_promotion');
            $table->float('ord_total_original');
            $table->float('ord_ship');
            $table->float('ord_total');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
