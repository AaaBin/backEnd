<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $news_id
 * @property string $img_url
 * @property string $created_at
 * @property string $updated_at
 * @property int $sort
 */
class News_img extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'news_img';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['news_id', 'img_url', 'created_at', 'updated_at', 'sort'];

}
