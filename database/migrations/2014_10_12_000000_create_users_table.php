<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('us_name')->nullable(false);
            $table->string('email')->nullable(false);
            $table->text('us_address')->nullable();
            $table->string('us_phone')->nullable();
            $table->string('us_gender')->nullable();
            $table->date('us_birthday')->nullable();
            $table->timestamp('us_email_verified_at')->nullable();
            $table->string('password')->nullable(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
