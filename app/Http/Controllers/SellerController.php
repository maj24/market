<?php

namespace App\Http\Controllers;
use App\Seller;

use Illuminate\Http\Request;
use Response;
use Validator;
use Illuminate\Support\Facades\Input;

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
        $rules = array(
            'name'      => 'required',
            'last_name' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(['message' => 'Faltaron campos']);
        } else {
            $attributes = $request->all();
            $seller = Seller::create($attributes);
            return Response::json($seller);
        }
    }

    public function update(Request $request, $id) {
        $rules = array(
            'name'      => 'required',
            'last_name' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(['message' => 'Faltaron campos']);
        } else {
            $seller = Seller::find($id);
            $attributes =  $request->all();
            $seller->update($attributes);
            return response()->json($seller);
        }
    }

    public function edit(Request $request, $id) {
        $rules = array(
            'name'      => 'nullable',
            'last_name' => 'nullable'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(['message' => 'Faltaron campos']);
        } else {
            $seller = Seller::find($id);
            if (Input::has('name')){
                $seller->name = $request->input('name');
            }
            if (Input::has('last_name')){
                $seller->last_name = $request->input('last_name');
            }
            $seller->update();
            
            return Response::json($seller);
        }
    }

    public function delete($id) {
        $removedSeller = Seller::find($id);
        $removedSeller->delete();
        return response()->json([], 200);
    }
}
