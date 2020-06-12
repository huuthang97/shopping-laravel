@extends('layouts.frontend')

@section('title', 'Category')

@section('content')
<input type="hidden" id="_url" data-url= "{{ url('/') }}">

<div class="features_items"><!--features_items-->
    <h2 class="title text-center">{{ $categoryName }}</h2>
    @if (!empty($products))
        @foreach ($products as $product)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="{{ asset($product->feature_image_path) }}" alt="" />
                                <h2>{{ $product->price }}</h2>
                                <p>{{ $product->name }}</p>
                                <a href="#" class="btn btn-default add-to-cart" data-id={{ $product->id }}><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            <div class="product-overlay">
                                <div class="overlay-content">
                                    <h2>{{ $product->price }}</h2>
                                    <p><a href="{{ route('product.detail', ['slug'=>$product->slug, 'id'=>$product->id ]) }}">{{ $product->name }}</a></p>
                                    <a href="#" class="btn btn-default add-to-cart" data-id={{ $product->id }}><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div>
                    </div>
                    {{-- <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        @endforeach
    @endif

</div><!--features_items-->
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('frontend/js/sidebar/main.js') }}"></script>
    <script src="{{ asset('frontend/js/cart/main.js') }}"></script>
    <script>
        $(document).ready(function(){
            let url = $('#_url').data('url');
            let img_loading = "{{ asset('frontend/images/Spinner-1s-200px.gif') }}";
            let categoryId = "{{ request()->segment(3)}}";
            // addToCart(url);
            filterPrice(categoryId);
            addToCart();
            search();
        });
    </script>
    
@endsection