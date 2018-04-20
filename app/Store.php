<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'telephone', 'password','detail','cat_id','status','store_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function store_cat(){
        return $this->belongsTo(Cat::class,'cat_id');
    }

    public function store_info(){
        return $this->belongsTo(Store_info::class,'store_id');
    }


}
