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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->foreignId('product_id')->constrained('products')->cascadeOnUpdate();
            $table->string('transaksi');
            $table->string('office');
            $table->string('partner');
            $table->date('jatuh_tempo');
            $table->string('payment_gateway');
            $table->string('signed_link')->nullable();
            $table->timestamp('link_expires_at')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
