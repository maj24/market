<?php

namespace App\Http\Controllers;
use App\Seller;

use Illuminate\Http\Request;
use Response;

class SellerController extends Controller
{
    public function index() {
        $sellers = Seller::with('address')->get();
        return response()->json($sellers);
    }

    public function show($id) {
        $seller = Seller::with('address')->find($id);
        return response()->json($seller);
    }

    public function store(Request $request) {
        $attributes = $request->all();
        $seller = Seller::create($attributes);
        return Response::json($seller);
    }

    public function update(Request $request, $id) {
        $seller = Seller::find($id);
        $attributes =  $request->all();
        $seller->update($attributes);
        return response()->json($seller);
    }

    public function edit(Request $request, $id) {
        $seller = Seller::find($id);
        $attributes = $request->input();
        $seller->update($attributes);
        return response()->json($seller);
    }

    public function delete($id) {
        $removedSeller = Seller::find($id);
        $removedSeller->delete();
        return response()->json([], 200);
    }
}
