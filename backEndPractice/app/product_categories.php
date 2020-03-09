<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property int $sort
 * @property string $created_at
 * @property string $updated_at
 */
class Product_categories extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'sort', 'created_at', 'updated_at'];

    public function product()
    {
        return $this->hasMany('App\Product','category','name')->orderby('sort','desc');
    }
}
