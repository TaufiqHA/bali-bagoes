<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
