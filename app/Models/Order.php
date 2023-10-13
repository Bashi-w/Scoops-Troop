<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['quantity','price', 'order_date', 'status','customer_id','branch_id'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
