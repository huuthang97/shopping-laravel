<?php

namespace App\Traits;

use App\Product;

trait CartTrait {
    
    public function addToCart($product_id, $qty) {
        $cart = session()->get('cart');
        $product = Product::find($product_id);
        if( isset($cart['buy'][$product_id]) ) {
            $cart['buy'][$product_id]['qty'] = $cart['buy'][$product_id]['qty'] + $qty;
            $cart['buy'][$product_id]['sub_total'] = $cart['buy'][$product_id]['qty'] * $cart['buy'][$product_id]['price'];
        }else{
            $cart['buy'][$product_id] = [
                'name' => $product->name,
                'price' => $product->price,
                'feature_image_path' => $product->feature_image_path,
                'qty' => $qty,
                'sub_total' => $product->price,
            ];
        }
        session()->put('cart', $cart);
        session()->save();
    }

    public function updateTotalCart() {
        $cart = session()->get('cart');
        $cart['total'] = 0;
        $cart['total_qty'] = 0;
        foreach ($cart['buy'] as $item) {
            $cart['total'] += $item['sub_total'];
            $cart['total_qty'] += $item['qty'];
        }
        session()->put('cart', $cart);
        session()->save();
    }
    
   


}