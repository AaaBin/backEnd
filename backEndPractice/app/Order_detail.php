<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $order_id
 * @property string $product_id
 * @property string $created_at
 * @property string $updated_at
 */
class Order_detail extends Model
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
    protected $fillable = ['order_id', 'product_id', 'created_at', 'updated_at'];

    public function product()
    {
        return $this->hasOne('App\Product',"id","product_id");
    }
}
