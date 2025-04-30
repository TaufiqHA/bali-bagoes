<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    protected $casts = [
        'jatuh_tempo' => 'datetime',
        'link_expires_at' => 'datetime',
    ];
    
}
