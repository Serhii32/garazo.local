<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordsCategory extends Model
{
    protected $fillable = [
        'title', 'photo', 'parent_id', 'titleSEO', 'descriptionSEO', 'keywordsSEO'
    ];
    public function products()
    {
        return $this->hasMany('App\Record');
    }
    public function childs() 
    {
        return $this->hasMany('App\RecordsCategory','parent_id','id') ;
    }
}
