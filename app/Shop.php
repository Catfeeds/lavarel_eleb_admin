<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'shop_name','shop_img', 'shop_rating','brand','on_time','bao','piao','zhun','start_send',
        'send_cost', 'distance', 'estimate_time','notice', 'distance', 'discount','fengniao'
    ];


}
