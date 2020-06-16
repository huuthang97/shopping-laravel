@extends('layouts.frontend-no-sidebar')

@section('title', 'Giỏ hàng')
    
@section('content')

<section id="cart_items">
    <input type="hidden" id="_url" data-url={{ url('/') }}>
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @if ( !empty($cart['buy']) )
                        @foreach ($cart['buy'] as $key => $item)
                            <tr class="test">
                                <td class="cart_product">
                                    <a href=""><img src="{{ asset($item['feature_image_path']) }}" width="80" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{ $item['name'] }}</a></h4>
                                    {{-- <p>Web ID: 1089772</p> --}}
                                </td>
                                <td class="cart_price">
                                    <p>{{ number_format($item['price']) }} đ</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" href="" data-qty=1> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity" data-product_id={{ $key }} value="{{ $item['qty'] }}" autocomplete="off" size="2">
                                        <a class="cart_quantity_down" href="" data-qty=-1> - </a>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">{{ number_format($item['sub_total']) }} đ</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" data-product_id={{ $key }}><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>TOTAL</h3>
        </div>
        <div class="row">
            {{--  <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                            
                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                        
                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>  --}}
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Số lượng <span id="qty-final">{{ $cart['total_qty'] ? number_format($cart['total_qty']) : 0 }}</span></li>
                        <li>Thành tiền <span id="total-final">{{ $cart['total'] ? number_format($cart['total']) : 0 }} đ</span></li>
                    </ul>
                        {{-- <a class="btn btn-default update" href="">Update</a> --}}
                        <a class="btn btn-default check_out" href="{{ route('cart.checkout') }}">Thanh toán</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->

@endsection


@section('js')
    <script src="{{ asset('frontend/js/cart/main.js') }}"></script>
    <script>
        $(document).ready(function(){
            var url = $('#_url').data('url');
            changeQuantityInput('.cart_quantity_up', url);
            changeQuantityInput('.cart_quantity_down', url);
            
            $(".cart_quantity_input").change(function(){
                var that = $(this);
                let qty = $(this).val();
                let product_id = $(this).parent().find('.cart_quantity_input').data('product_id');
                if(qty <= 0){
                    deleteAjaxCart(product_id, that, url);
                }else{
                    updateAjaxCart(product_id, qty, url, that);
                }

            });

            $(".cart_quantity_delete").click(function(){
                var that = $(this);
                let product_id = $(this).data('product_id');
                deleteAjaxCart(product_id, that, url);
            });
            
        });
    </script>
@endsection
