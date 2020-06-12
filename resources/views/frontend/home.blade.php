@extends('layouts.frontend')

@section('title', 'Trang chủ')

@section('content')

<input type="hidden" id="_url" data-url= "{{ url('/') }}">
<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">NEW</h2>
        @if (!empty($products))
            @foreach ($products as $product)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset($product->feature_image_path) }}"  />
                                    <h2>{{ $product->price }}</h2>
                                    <p>{{ $product->name }}</p>
                                    <a href="#" class="btn btn-default add-to-cart" data-id={{ $product->id }}><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                <div class="product-overlay">
                                    <div class="overlay-content">
                                        <p><a href="{{ route('product.detail', ['slug'=>$product->slug, 'id'=>$product->id ]) }}">{{ $product->name }}</a></p>
                                        <a href="#" class="btn btn-default add-to-cart" data-id={{ $product->id }}><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                </div>
                        </div>
                        <div class="choose">
                            <ul class="nav nav-pills nav-justified">
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div><!--features_items-->
    
    <div class="category-tab"><!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#product-rand" data-toggle="tab">Random</a></li>
                @foreach ($categories as $category)
                    <li><a href="{{ '#'.$category->name }}" data-toggle="tab">{{ $category->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="tab-content">
            @if( !empty($productsRand) )
            <div class="tab-pane fade active in" id="product-rand" >
                @foreach ($productsRand as $product)
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{ asset($product->feature_image_path) }}" />
                                    <h2>{{ $product->price }}</h2>
                                    <p><a style="color:#696763" href="{{ route('product.detail', ['slug'=>$product->slug, 'id'=>$product->id ]) }}">{{ $product->name }}</a></p>
                                    <a href="javascript:;" class="btn btn-default add-to-cart" data-id={{ $product->id }}><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif

            @if (!empty($categories))
                @foreach ($categories as $category)
                    <div class="tab-pane fade" id="{{ $category->name }}" >
                        @php 
                            $producNumShow = 4;
                            if (count($category->productRecursive($category->id)) < 4 ) {
                                $producNumShow = count($category->productRecursive($category->id));
                            }
                        @endphp
                        @foreach ( Arr::random($category->productRecursive($category->id), $producNumShow); as $product)
                            <div class="col-sm-3">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ asset($product->feature_image_path) }}"  />
                                            <h2>{{ $product->price }}</h2>
                                            <p><a style="color:#696763" href="{{ route('product.detail', ['slug'=>$product->slug, 'id'=>$product->id ]) }}">{{ $product->name }}</a></p>
                                            <a href="#" class="btn btn-default add-to-cart" data-id={{ $product->id }}><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @endif
            
        </div>
    </div><!--/category-tab-->
    
    @if (!empty($recommendProducts))
    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">RECOMMEND</h2>
        
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src={{ asset($recommendProducts[$i]['feature_image_path']) }}  />
                                        <h2>{{ $recommendProducts[$i]['price'] }}</h2>
                                        <p><a style="color:#696763" href="{{ route('product.detail', ['slug'=>$recommendProducts[$i]['slug'], 'id'=>$recommendProducts[$i]['id'] ]) }}">{{ $recommendProducts[$i]['name'] }}</a></p>
                                        <a href="#" class="btn btn-default add-to-cart" data-id={{ $recommendProducts[$i]['id'] }}><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    @endfor    
                </div>
                @if (count($recommendProducts) > 3)
                <div class="item">	
                    @for ($i = count($recommendProducts) - 1; $i > 2; $i--)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src={{ asset($recommendProducts[$i]['feature_image_path']) }}  />
                                        <h2>{{ $recommendProducts[$i]['price'] }}</h2>
                                        <p><a style="color:#696763" href="{{ route('product.detail', ['slug'=>$recommendProducts[$i]['slug'], 'id'=>$recommendProducts[$i]['id'] ]) }}">{{ $recommendProducts[$i]['name'] }}</a></p>
                                        <a href="#" class="btn btn-default add-to-cart" data-id={{ $recommendProducts[$i]['id'] }}><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor    
                </div>
                @endif
            </div>
             <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
              </a>
              <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
              </a>			
        </div>
    </div><!--/recommended_items-->
    @endif
    
    
</div>
@endsection


@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('frontend/js/sidebar/main.js') }}"></script>
    <script src="{{ asset('frontend/js/cart/main.js') }}"></script>
    <script>
        $(document).ready(function(){
            addToCart();
            filterPrice();
            search();
            
            
        });
    </script>
    
@endsection