<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;
use App\Category;


class SidebarController extends Controller
{
    public function filterPrice(Request $request) {
        $categoryId = (int) $request->categoryId;
        $strprice = $request->strPrice;
        $arrPrice = Str::of($strprice)->explode(' ');
        $minPrice = (int) $arrPrice[0];
        $maxPrice = (int) $arrPrice[2];
        if ($request->categoryId == '') {
            $products = Product::orderBy('price', 'ASC')->take(6)->get();
            $result = '<h2 class="title text-center">NEW</h2>';
        }else {
            $products = Product::where('category_id', $categoryId)
                            ->whereBetween('price', [$minPrice, $maxPrice])
                            ->orderBy('price', 'ASC')
                            ->get();
            $categoryName = Category::find($categoryId)->slug;
            $result = '<h2 class="title text-center">' .$categoryName. '</h2>';
        }
        

        if ( count($products) > 0 ) {
            foreach ($products as $product) {
                $result .= '<div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">'.
                                            '<img src='. asset($product->feature_image_path) . '/>'.
                                            '<h2>' .$product->price .'</h2>'.
                                            '<p>'  .$product->name. '</p>'.
                                            '<a href="#" class="btn btn-default add-to-cart" data-id=' .$product->id. '><i class="fa fa-shopping-cart"></i>Add to cart</a>'.
                                        '</div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">'.
                                                '<h2>' .$product->price. '</h2>'.
                                                '<p>' .$product->name. '</p>'.
                                                '<p><a href='. route('product.detail', ['slug'=>$product->slug, 'id'=>$product->id ]). '>'. $product->name. '</a></p>'.
                                                '<a href="#" class="btn btn-default add-to-cart" data-id=' .$product->id. '><i class="fa fa-shopping-cart"></i>Add to cart</a>'.
                                            '</div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            
            }
        }else {
            $result = '<h4 style="color:#FE980F;" class="text-center">Không có sản phẩm nào phù hợp!</h4>';
        }
        $result .= "<script>
                        addToCart();
                    </script>";
                    
        echo $result;
    }
    
}
