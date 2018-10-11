<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'title', 'main_photo', 'short_description', 'description', 'category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\RecordsCategory');
    }
}
