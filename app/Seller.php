<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable = ['name', 'last_name'];


    public function address()
    {
        return $this->belongsTo('App\Address');
    }

    public function products() 
    {
        return $this->hasMany('App\Product');
    }
}
