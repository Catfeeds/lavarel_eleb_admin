<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store_info extends Model
{
    protected $fillable = [
        'store_name','store_img', 'store_rating','brand','on_time','bao','piao','zhun','start_send',
        'send_cost', 'distance', 'estimate_time','notice', 'distance', 'discount','fengniao'
    ];


}
