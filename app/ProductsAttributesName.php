<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsAttributesName extends Model
{
	protected $fillable = [
        'name',
    ];

    public function products()
    {
    	return $this->belongsToMany('App\Product', 'product_products_attributes_name', 'product_id', 'products_attributes_name_id')->withTimestamps();
    }
}
