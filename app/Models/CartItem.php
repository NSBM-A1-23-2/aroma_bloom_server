<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['quantity', 'cart_id', 'candle_id'];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function candle()
    {
        return $this->belongsTo(Candle::class);
    }
}
