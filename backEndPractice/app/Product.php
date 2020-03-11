<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'url','name','category','sort','price'
    ];
    public function categories()
    {
        return $this->belongsTo('App\product_categories','category','name');
    }
}
