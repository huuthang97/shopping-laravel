@extends('layouts/frontend')

@section('title', 'product-detail')
    
@section('content')

<div class="col-sm-9 padding-right">
    @if (\Session::has('message'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('message') !!}</li>
            </ul>
        </div>
    @endif
    <div class="product-details"><!--product-details-->
        <div class="col-sm-5">
            <div class="view-product">
                <img src="{{ asset($product->feature_image_path) }}"/>
                <h3>ZOOM</h3>
            </div>
            <div id="similar-product" class="carousel slide" data-ride="carousel">
                
                  <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                          <a href=""><img src="{{ asset('frontend/images/product-details/similar1.jpg') }}" alt=""></a>
                          <a href=""><img src="{{ asset('frontend/images/product-details/similar2.jpg') }}" alt=""></a>
                          <a href=""><img src="{{ asset('frontend/images/product-details/similar3.jpg') }}" alt=""></a>
                        </div>
                        <div class="item">
                          <a href=""><img src="{{ asset('frontend/images/product-details/similar1.jpg') }}" alt=""></a>
                          <a href=""><img src="{{ asset('frontend/images/product-details/similar2.jpg') }}" alt=""></a>
                          <a href=""><img src="{{ asset('frontend/images/product-details/similar3.jpg') }}" alt=""></a>
                        </div>
                        <div class="item">
                          <a href=""><img src="{{ asset('frontend/images/product-details/similar1.jpg') }}" alt=""></a>
                          <a href=""><img src="{{ asset('frontend/images/product-details/similar2.jpg') }}" alt=""></a>
                          <a href=""><img src="{{ asset('frontend/images/product-details/similar3.jpg') }}" alt=""></a>
                        </div>
                    </div>

                  <!-- Controls -->
                  <a class="left item-control" href="#similar-product" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                  </a>
                  <a class="right item-control" href="#similar-product" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                  </a>
            </div>

        </div>
        <div class="col-sm-7">
            <form action="{{ route('cart.postAdd') }}" method="POST">
                @csrf
                <div class="product-information"><!--/product-information-->
                    <img src="images/product-details/new.jpg" class="newarrival" alt="" />
                    <h2>{{ $product->name }}</h2>
                    <img src="images/product-details/rating.png" alt="" />
                    <span>
                        <span>{{ number_format($product->price) }} đ</span>
                        <label>Số lượng:</label>
                        <input type="number" name="input_qty" value="1" min=1 />
                        <input type="hidden" name="product_id" value={{ request()->segment(3) }} min=0 />
                        <button type="submit" class="btn btn-fefault cart">
                            <i class="fa fa-shopping-cart"></i>
                            Add to cart
                        </button>
                    </span>
                    <p><b>Tình trạng:</b> Còn hàng</p>
                    <p><b>Trạng thái:</b> New</p>
                    {{-- <p><b>Nhãn hiệu:</b> E-SHOPPER</p> --}}
                    {{-- <a href=""><img src="{{ asset('frontend/images/product-details/share.png') }}" class="share img-responsive"  alt="" /></a> --}}
                </div><!--/product-informdation-->    
            </form>
        </div>
    </div><!--/product-details-->
    
    <div class="category-tab shop-details-tab"><!--category-tab-->
        <div class="col-sm-12">
            <ul class="nav nav-tabs">
                <li><a href="#details" data-toggle="tab">Details</a></li>
                {{-- <li><a href="#tag" data-toggle="tab">Tag</a></li> --}}
                <li class="active"><a href="#reviews" data-toggle="tab">Reviews ({{ count($product->comments) }})</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade" id="details" >
                <div class="col-sm-11">
                    {!! $product->content !!}
                </div>
                
            </div>
            
            {{-- <div class="tab-pane fade" id="tag" >
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="images/home/gallery1.jpg" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="images/home/gallery2.jpg" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="images/home/gallery3.jpg" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="images/home/gallery4.jpg" alt="" />
                                <h2>$56</h2>
                                <p>Easy Polo Black Edition</p>
                                <button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="tab-pane fade active in" id="reviews" >
                <div class="col-sm-12">
                    @if ( count($product->comments) > 1)
                        @foreach ($product->comments as $comment)
                        <ul>
                            <li><a><i class="fa fa-user"></i>{{ $comment->name }}</a></li>
                            <li><a><i class="fa fa-clock-o"></i>{{ $comment->created_at }}</a></li>
                            {{-- <li><a><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li> --}}
                            <li>
                                @for( $i = 0; $i < $comment->rating; $i++)
                                    <i class="fa fa-star"></i>
                                @endfor
                            </li>
                            <br/>
                            <li><a>{{ $comment->content }}<a></li>
                        </ul>
                        
                        @endforeach
                    @endif
                    
                    <p><b>Đánh giá</b></p>
                    
                    <form action="{{ route('product.comment') }}" method="POST">
                        @csrf
                        <span>
                            <input type="text" name="name" required placeholder="Your Name"/>
                            <input type="email" name="email" required placeholder="Email Address"/>
                        </span>
                        <textarea name="content" required></textarea>
                        {{-- <b>Rating: </b> <img src="images/product-details/rating.png" alt="" /> --}}
                        <b>Rating:</b>
                        <input type="radio" name="rating" value="1"> 
                        <input type="radio" name="rating" value="2"> 
                        <input type="radio" name="rating" value="3"> 
                        <input type="radio" name="rating" value="4"> 
                        <input type="radio" checked name="rating" value="5">
                        <input type="hidden" name="product_id" value={{ request()->segment(3) }}>
                        <button type="submit" class="btn btn-default pull-right">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/category-tab-->
   {{-- {{ dd($productRecommend[0]['price']) }} --}}
    <div class="recommended_items"><!--recommended_items-->
        <h2 class="title text-center">De xuat</h2>
        
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="item active">
                    @php
                        $limitProductRecommend = count($productRecommend);
                        if( $limitProductRecommend > 3) {
                            $limitProductRecommend = 3;
                        }
                    @endphp
                    @for ($i = 0; $i < $limitProductRecommend; $i++)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{ asset($productRecommend[$i]['feature_image_path']) }}"  />
                                        <h2>{{ $productRecommend[$i]['price'] }}</h2>
                                        <p><a href="{{ route('product.detail', ['slug'=>$productRecommend[$i]['slug'], 'id'=>$productRecommend[$i]['id'] ]) }}">{{ $productRecommend[$i]['name'] }}</a></p>
                                        <button type="button" class="btn btn-default add-to-cart" data-id={{ $productRecommend[$i]['id'] }}><i class="fa fa-shopping-cart"></i>Add to cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>

                @if ($limitProductRecommend > 3)
                    @php
                        $limitProductRecommend_2 = count($productRecommend);
                        if( $limitProductRecommend_2 > 6) {
                            $limitProductRecommend_2 = 6;
                        }
                    @endphp
                    <div class="item">	
                        @for ($i = 3; $i < $limitProductRecommend_2; $i++)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ asset($productRecommend[$i]['feature_image_path']) }}" alt="" />
                                            <h2>{{ $productRecommend[$i]['price'] }}</h2>
                                            <p><a href="{{ route('product.detail', ['slug'=>$productRecommend[$i]['slug'], 'id'=>$productRecommend[$i]['id'] ]) }}">{{ $productRecommend[$i]['name'] }}</a></p>
                                            <button type="button" class="btn btn-default add-to-cart" data-id={{ $productRecommend[$i]['id'] }}><i class="fa fa-shopping-cart"></i>Add to cart</button>
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
    
</div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('frontend/js/sidebar/main.js') }}"></script>
    <script src="{{ asset('frontend/js/cart/main.js') }}"></script>
    <script>
        $(document).ready(function(){
            addToCart();
            search();
            
            
        });
    </script>
    
@endsection