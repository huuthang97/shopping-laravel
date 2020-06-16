<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class HomeController extends Controller
{
    private $product;
    private $category;
    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    public function index(Request $request) {
        $products = $this->product->latest()->take(6)->get();
        $recommendProducts = $this->product->inRandomOrder()->take(6)->get();
        $categories = $this->category->where('parent_id', 0)->inRandomOrder()->take(5)->get();
        $productsRand = $this->product->inRandomOrder()->take(4)->get();
        
        return view('frontend.home', compact('products', 'recommendProducts', 'categories', 'productsRand'));
    }

    public function search(Request $request) {
        $keyWord = $request->keyWord;
        if ( trim($keyWord) == '' ) {return false;}
        $products = $this->product->where('name', 'LIKE', '%'.$keyWord.'%')->take(6)->get();
        $result = '<div class="item-search text-center" >Không tìm thấy kết quả!</div>';
        if ( count($products) > 0) {
            $result = '';
            foreach ( $products as $product ) {
                $result .= '
                    <div class="item-search" >
                        <a class="" href=""><img width="50"  src=' .asset($product->feature_image_path). '></a>
                        <a class="" href="">' .$product->name. '</a>
                        <a class="" href="">' .number_format($product->price). ' đ</a>
                    </div>            
                ';
            }
        }
        
        echo $result;
    }
}
