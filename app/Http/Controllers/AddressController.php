<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\Seller;

class AddressController extends Controller
{
    public function store(Request $request, $idSeller) {
        $attributes = $request->all();
        $seller = Seller::find($idSeller);
        $address = Address::create($attributes);
        $seller->address_id = $address->id;
        $seller->save();
        return response()->json($seller);
    }
    public function update (Request $request, $idSeller) {
        $attributes = $request->all();
        $seller = Seller::find($idSeller);
        $address = Address::find($seller->address_id);
        $address->update($attributes);
        return response()->json($address);
    }
}
