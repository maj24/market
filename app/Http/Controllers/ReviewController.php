<?php
namespace App\Http\Controllers;
use App\Product;
use App\Review;
use Illuminate\Http\Request;
use Response;
use Validator;
use Illuminate\Support\Facades\Input;

class ReviewController extends Controller
{
    public function store(Request $request, $id) {
        $rules = array(
            'reviewer_name'	=> 'required',
            'title' 		=> 'required',
            'content' 		=> 'required',
            'date' 			=> 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(['message' => 'Faltaron campos']);
        } else {
            $review = new Review();
	        $review->reviewer_name = $request->input('reviewer_name');
	        $review->title = $request->input('title');
	        $review->content = $request->input('content');
	        $review->date = $request->input('date');
	        $review->product_id = $id;
	        $review->save();

	        return Response::json($review);
	    }
    }
    public function index(Request $request, $id) {
        $product = Product::with('reviews')->find($id);
        return response()->json($product->reviews);
    }
    public function delete(Request $request, $productId, $reviewId) {
        $review = Review::find($reviewId);
        $review->delete();
        return response()->json($review);
    }
}