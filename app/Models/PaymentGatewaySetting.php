<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentGatewaySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'gateway_name',
        // Sandbox keys
        'sandbox_merchant_id',
        'sandbox_client_id',
        'sandbox_client_key',
        'sandbox_server_key',
        'sandbox_secret_key',
        'sandbox_public_key',
        'sandbox_merchant_key',
        'sandbox_api_key',
        // Production keys
        'production_merchant_id',
        'production_client_id',
        'production_client_key',
        'production_server_key',
        'production_secret_key',
        'production_public_key',
        'production_merchant_key',
        'production_api_key',
        // Additional settings
        'sandbox_additional_settings',
        'production_additional_settings',
        'is_active',
        'is_set',
        'use_sandbox'
    ];

    protected $casts = [
        'sandbox_additional_settings' => 'array',
        'production_additional_settings' => 'array',
        'is_active' => 'boolean',
        'use_sandbox' => 'boolean'
    ];

    /**
     * Get settings for a specific gateway
     */
    public static function forGateway(string $gatewayName): ?self
    {
        return self::where('gateway_name', $gatewayName)->first();
    }

    /**
     * Get the current active keys (sandbox or production)
     */
    public function getActiveKeys()
    {
        if ($this->use_sandbox) {
            return [
                'merchant_id' => $this->sandbox_merchant_id,
                'client_id' => $this->sandbox_client_id,
                'client_key' => $this->sandbox_client_key,
                'server_key' => $this->sandbox_server_key,
                'secret_key' => $this->sandbox_secret_key,
                'public_key' => $this->sandbox_public_key,
                'merchant_key' => $this->sandbox_merchant_key,
                'api_key' => $this->sandbox_api_key,
                'additional_settings' => $this->sandbox_additional_settings ?? []
            ];
        }

        return [
            'merchant_id' => $this->production_merchant_id,
            'client_id' => $this->production_client_id,
            'client_key' => $this->production_client_key,
            'server_key' => $this->production_server_key,
            'secret_key' => $this->production_secret_key,
            'public_key' => $this->production_public_key,
            'merchant_key' => $this->production_merchant_key,
            'api_key' => $this->production_api_key,
            'additional_settings' => $this->production_additional_settings ?? []
        ];
    }

    /**
     * Get a specific setting value based on current environment
     */
    public function getSetting(string $key, $default = null)
    {
        $activeKeys = $this->getActiveKeys();
        
        // First check in main keys
        if (isset($activeKeys[$key])) {
            return $activeKeys[$key];
        }

        // Then check in additional_settings
        return $activeKeys['additional_settings'][$key] ?? $default;
    }
}
