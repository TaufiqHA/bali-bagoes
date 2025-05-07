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
        Schema::create('payment_gateway_settings', function (Blueprint $table) {
            $table->id();
            $table->string('gateway_name'); // midtrans, duitku, doku, xendit, etc
            
            // Sandbox Environment Keys
            $table->string('sandbox_merchant_id')->nullable();
            $table->string('sandbox_client_id')->nullable();
            $table->string('sandbox_client_key')->nullable();
            $table->string('sandbox_server_key')->nullable();
            $table->string('sandbox_secret_key')->nullable();
            $table->string('sandbox_public_key')->nullable();
            $table->string('sandbox_merchant_key')->nullable();
            $table->string('sandbox_api_key')->nullable();
            
            // Production Environment Keys
            $table->string('production_merchant_id')->nullable();
            $table->string('production_client_id')->nullable();
            $table->string('production_client_key')->nullable();
            $table->string('production_server_key')->nullable();
            $table->string('production_secret_key')->nullable();
            $table->string('production_public_key')->nullable();
            $table->string('production_merchant_key')->nullable();
            $table->string('production_api_key')->nullable();
            
            // Additional fields storage as JSON for gateway-specific settings
            $table->json('sandbox_additional_settings')->nullable();
            $table->json('production_additional_settings')->nullable();
            
            $table->boolean('is_active')->default(false);
            $table->boolean('use_sandbox')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_gateway_settings');
    }
};
