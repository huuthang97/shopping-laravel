<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class CategoryController extends Controller
{
    public function index($slug, $id) {
        $categoryName = Category::find($id)->slug;
        $products = Product::where('category_id', $id)->get();
        
        return view('frontend.category.index', compact('categoryName', 'products'));
    }
}
