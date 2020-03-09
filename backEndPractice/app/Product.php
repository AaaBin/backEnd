<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'url','category','sort'
    ];
    public function categories()
    {
        return $this->belongsTo('App\product_categories','category','name');
    }
}
