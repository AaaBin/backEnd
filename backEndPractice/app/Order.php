<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $user_id
 * @property int $recipient_name
 * @property int $recipient_phone
 * @property int $recipient_address
 * @property int $recipient_email
 * @property int $total_price
 * @property string $order_time
 * @property string $payment_status
 * @property string $send_status
 * @property string $created_at
 * @property string $updated_at
 */
class Order extends Model
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
    protected $fillable = ['user_id', 'recipient_name', 'recipient_phone', 'recipient_address', 'recipient_email', 'total_price', 'order_time', 'payment_status', 'send_status', 'created_at', 'updated_at'];

    public function order_detail()
    {
        return $this->hasMany('App\Order_detail');
    }
}
