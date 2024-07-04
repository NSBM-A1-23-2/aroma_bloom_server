<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['rating', 'comment', 'customer_id', 'candle_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function candle()
    {
        return $this->belongsTo(Candle::class);
    }
}
