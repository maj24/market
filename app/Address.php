<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['address', 'city', 'state', 'country', 'postal_code'];
    public $timestamps = false;

    public function seller()
    {
        return $this->hasOne('App\Seller');
    }
}
