<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{


    public function reviews()
    {
        return $this->hasMany('App\Review');
    }

    public function tags()
    {
    	return $this->belongsToMany('App\Tag');
    }

    public function seller() 
    {
        return $this->belongsTo('App\Seller', 'seller_id');
    }

}
