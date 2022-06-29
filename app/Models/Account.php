<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Account extends Authenticatable
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $guarded = [];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
