<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Comment;

class ProductController extends Controller
{
    public function getDetail($slug, $id) {
        $product = Product::find($id);
        $productRecommend = [];
        foreach ( $product->tags as $tag) {
            foreach ($tag->products as $product ) {
                if( $product->id != $id) {
                    $productRecommend[$product->id] = $product;
                }
            }
        }
        $productRecommend = array_values($productRecommend);
        
        return view('frontend.product.detail', compact('product', 'productRecommend'));
    }

    public function comment(Request $request) {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'content' => $request->content,
            'rating' => (int) $request->rating,
            'product_id' => (int) $request->product_id,
        ];
        $product = Comment::create($data);
        return redirect()->back();
    }
}
