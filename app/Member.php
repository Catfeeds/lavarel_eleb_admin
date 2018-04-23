<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','detail','cat_id','status','shop_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function shop_cat(){
        return $this->belongsTo(Cat::class,'cat_id');
    }

    public function shop(){
        return $this->belongsTo(Shop::class,'shop_id');
    }


}
