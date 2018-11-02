<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SEO_Page extends Model
{
    protected $fillable = [
        'page', 'titleSEO', 'descriptionSEO', 'keywordsSEO'
    ];
}
