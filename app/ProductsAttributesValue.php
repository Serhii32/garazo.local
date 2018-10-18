<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsAttributesValue extends Model
{
	protected $fillable = [
        'value',
    ];
    
    public function products()
    {
    	return $this->belongsToMany('App\Product', 'product_products_attributes_value', 'products_attributes_value_id', 'product_id')->withTimestamps();
    }

    public function names()
    {
    	return $this->belongsToMany('App\ProductsAttributesName', 'products_attributes_name_products_attributes_value', 'products_attributes_value_id', 'products_attributes_name_id')->withTimestamps();
    }
}
