<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['quantity', 'orderDate', 'customer_id', 'candle_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function candle()
    {
        return $this->belongsTo(Candle::class);
    }
}
