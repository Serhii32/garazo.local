<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'price', 'main_photo', 'short_description', 'description', 'category_id', 'most_saled', 'novelty', 'promo_action', 'best',
    ];

    public function category()
    {
        return $this->belongsTo('App\ProductsCategory');
    }

    public function attributesNames()
    {
    	return $this->belongsToMany('App\ProductsAttributesName', 'product_products_attributes_name', 'product_id', 'products_attributes_name_id')->withTimestamps();
    }

    public function attributesValues()
    {
    	return $this->belongsToMany('App\ProductsAttributesValue', 'product_products_attributes_value', 'product_id', 'products_attributes_value_id')->withTimestamps();
    }

    public function orders()
    {
        // return $this->belongsToMany('App\Order', 'order_product', 'product_id', 'order_id', 'price', 'quantity')->withTimestamps();
        return $this->belongsToMany('App\Order', 'order_product', 'product_id', 'order_id')->withPivot('price', 'quantity')->withTimestamps();
    }
}
