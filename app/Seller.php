<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $fillable = ['name', 'last_name'];


    public function address()
    {
        return $this->hasOne('App\Address');
    }
}
