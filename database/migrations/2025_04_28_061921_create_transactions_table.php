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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id')->nullable(); // user_id dibuat saat callback berhasil
            $table->integer('gross_amount');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('gateway');
            $table->timestamps();

            // Relasi ke products table (pastikan ada table products)
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            // Optional, relasi ke users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
