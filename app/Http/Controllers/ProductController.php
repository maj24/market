<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Illuminate\Database\Eloquent\Collection;
use App\Seller;
use App\Product;
use Response;
use Validator;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('seller', 'tags')->get();
        return Response::json($products);
    }

    public function show($id) {
        $product = Product::with('seller', 'tags')->find($id);
        return response()->json($product);
    }

    public function store(Request $request) {
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->seller_id = $request->input('seller_id');
        $product->save();

        $tagsData = $request->input('tags');
        $tags = [];
        foreach ($tagsData as $tagData) {
            $tag = Tag::firstOrCreate(['name'=>$tagData]);
            array_push($tags, $tag);
        }
        $tags = Collection::make($tags);
        $product->tags()->saveMany($tags);
        
        return Response::json($product);
    }

    public function update(Request $request, $id) {
        $rules = array(
            'name' 			=> 'required',
            'description' 	=> 'required',
            'price' 		=> 'required',
            'seller_id' 	=> 'required',
            'tags'			=> 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(['message' => 'Faltaron campos']);
        } else {
            $product = Product::with('tags')->find($id);
	        $product->name = $request->input('name');
	        $product->description = $request->input('description');
	        $product->price = $request->input('price');
	        $product->seller_id = $request->input('seller_id');
	        $product->update();

            $tagsData = $request->input('tags');
	        $tags = [];
	        foreach ($tagsData as $tagData) {
	            $tag = Tag::firstOrCreate(['name'=>$tagData]);
	            array_push($tags, $tag);
	        }
	        $tags = Collection::make($tags);
	        $product->tags()->saveMany($tags);
	        return Response::json($product);
	    }
    }

    public function edit(Request $request, $id) {
        $rules = array(
            'name' 			=> 'nullable',
            'description' 	=> 'nullable',
            'price' 		=> 'nullable',
            'seller_id' 	=> 'nullable',
            'tags'			=> 'nullable'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(['message' => 'Faltaron campos']);
        } else {
            $product = Product::with('tags')->find($id);
            if (Input::has('name')){
		        $product->name = $request->input('name');
		    }
		    if (Input::has('description')){
		        $product->description = $request->input('description');
		    }
		    if (Input::has('price')){
		        $product->price = $request->input('price');
		    }
		    if (Input::has('seller_id')){
		        $product->seller_id = $request->input('seller_id');
		    }
	        $product->update();

	        if (Input::has('tags')){
		        $tagsData = $request->input('tags');
		        $tags = [];
		        foreach ($tagsData as $tagData) {
		            $tag = Tag::firstOrCreate(['name'=>$tagData]);
		            array_push($tags, $tag);
		        }
		        $tags = Collection::make($tags);
		        $product->tags()->saveMany($tags);
		    }

            
	        return Response::json($product);
	    }
    }

    public function delete($id) {
        $product = Product::find($id);
        $product->delete();
        return response()->json([], 200);
    }
}
