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
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('cate_id');
            $table->string('cate_name')->nullable(false);
            $table->integer('cate_parent_id')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE categories ADD cate_img LONGBLOB NULL");
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
