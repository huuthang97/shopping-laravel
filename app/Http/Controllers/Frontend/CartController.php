<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Bill;
use App\Customer;
use App\Traits\CartTrait;

class CartController extends Controller
{
    use CartTrait;

    public function index() {
        $cart = session()->get('cart');
        return view('frontend.cart.index', compact('cart'));
    }

    public function add(Request $request) {
        $product_id = (int) $request->id;
        $this->addToCart($product_id, 1);
        $this->updateTotalCart();
        
        return response()->json([
            'code' => 200,
            'message' => 'success!'
        ]);
        
    }
    public function postAdd(Request $request) {
        $qty = (int) $request->input_qty;
        $product_id = (int) $request->product_id;
        if ( $qty > 0 ) {
            $this->addToCart($product_id, $qty);
            $this->updateTotalCart();
            return redirect()->back()->with('message', 'Thêm vào giỏ hàng thành công!');
        }
        
    }

    public function update(Request $request) {
        $product_id = $request->product_id;
        $qty = $request->qty;
        $cart = session()->get('cart');
        $price = $cart['buy'][$product_id]['price'];
        $cart['buy'][$product_id]['qty'] = $qty;
        $cart['buy'][$product_id]['sub_total'] = $qty * $price;
        session()->put('cart', $cart);
        session()->save();
        $this->updateTotalCart($cart);

        $cart = session()->get('cart');
        return response()->json([
            'code' => 200,
            'qty' => $qty,
            'sub_total' => number_format($qty * $price),
            'total_qty' => $cart['total_qty'],
            'total' => number_format($cart['total'])
        ]);
    }

    public function delete(Request $request) {
        $product_id = $request->product_id;
        $cart = session()->get('cart');
        unset($cart['buy'][$product_id]);
        session()->put('cart', $cart);
        session()->save();
        $this->updateTotalCart();
        $cart = session()->get('cart');
        
        return response()->json([
            'code' => 200,
            'message' => 'success!',
            'total_qty' => $cart['total_qty'],
            'total' => number_format($cart['total'])
        ]);
    }

    public function getCheckout(Request $request) {
        return view('frontend.cart.checkout');
    }
    
    public function postCheckout(Request $request) {
        $name = trim($request->name);
        $phone = trim($request->phone);
        $email = trim($request->email);
        $address = $request->address;
        $note = $request->note;
        $data = [
            'name' => $name, 
            'email' => $email, 
            'phone' => $phone, 
            'address' => $address, 
            'note' => $note
        ];
        $json_bill = json_encode(session()->get('cart'));

        $existPhone = Customer::where('phone', $phone)->exists();
        $existEmail = $email == '' ? false : Customer::where('email', $email)->exists();
        
        if ( $existPhone == true ) {
            $customer = Customer::where('phone', $phone)->update($data);
        }
        else if ( $existEmail == true ) {
            $customer = Customer::where('email', $email)->update($data);
        }
        else{
            $customer = Customer::create($data);
        }
        // dd($customer);
        Bill::create([
            'json_bill' => $json_bill,
            'customer_id' => $customer
        ]);
        return redirect()->back()->with('success', 'Mua hàng thành công! nhân viên sẽ liên lạc lại với quý khách.');
    }
}
