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
    	return $this->belongsToMany('App\Product', 'product_products_attributes_value', 'product_id', 'products_attributes_value_id')->withTimestamps();
    }
}
