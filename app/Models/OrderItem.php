<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    
use HasFactory;
protected $fillable = ['order_id','product_id', 'topping_id', 'serving','quantity'];

public function order()
{
    return $this->belongsTo(Order::class);
}

public function product()
{
    return $this->belongsTo(Product::class);
}

// Define the relationship with the Topping model
public function topping()
{
    return $this->belongsTo(Topping::class);
}
}
