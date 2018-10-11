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
}
