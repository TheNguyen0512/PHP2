<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('pro_id');
            $table->string('pro_name')->nullable(false);
            $table->string('pro_brand')->unullable(false);
            $table->text('pro_description')->nullable();
            $table->float('pro_price', 8, 2)->nullable(false);
            $table->integer('pro_quantity')->default(0);
            $table->tinyInteger('pro_status')->default(0);
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')->references('cate_id')->on('categories');
            $table->tinyInteger('is_featured')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE products ADD pro_img LONGBLOB NOT NULL");
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
