<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'discount', 'expiration_date'];

    // Check if the promo code is valid
    public function isValid()
    {
        return $this->expiration_date >= now();
    }
}
