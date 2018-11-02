<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'status', 'name', 'email', 'phone', 'delivery', 'payment', 'totalSum'
    ];

    public function products()
    {
        // return $this->belongsToMany('App\Order', 'order_product', 'order_id', 'product_id', 'price', 'quantity')->withTimestamps();
        return $this->belongsToMany('App\Product', 'order_product', 'order_id', 'product_id')->withPivot('price', 'quantity')->withTimestamps();
    }
}
