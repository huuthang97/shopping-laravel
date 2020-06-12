@php
 $sliders = App\Slider::orderBy('created_at', 'desc')->get();
@endphp
@if ( count($sliders) > 0)
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach ($sliders as $key => $slider)
                            <li data-target="#slider-carousel" data-slide-to="{{ $key }}" class="{{ $key== 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    
                    <div class="carousel-inner">
                        @foreach ($sliders as $key => $slider)
                            <div class="item {{ $key== 0 ? 'active' : '' }}">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-8">
                                    <img src="{{ asset($slider->image_path) }}" class="girl img-responsive" alt="" />
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                        @endforeach
                    </div>
                    
                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</section><!--/slider-->
@endif
