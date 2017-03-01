<?php
namespace App\Http\Controllers;
use App\Product;
use App\Review;
use Illuminate\Http\Request;
class ReviewController extends Controller
{
    public function store(Request $request, $id) {
        $attributes = $request->all();
        $review = Review::create($attributes);
        $review->product_id = $review->id;
        $review->save();
        return response()->json($review);
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