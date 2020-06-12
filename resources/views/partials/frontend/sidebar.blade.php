@php
$maxPrice = App\Product::max('price');
$minPrice = App\Product::min('price');
$categories = App\Category::where('parent_id', 0)->get();

function categoryRecursive ($cats) {
    $result = '';
    foreach ($cats as $cat ) {
        $subCats = App\Category::where('parent_id', $cat->id)->get();
        if (count($subCats) > 0 ) {
            $result .= '<div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">'.
                        '<a data-toggle="collapse"  href=#'. $cat->slug.$cat->id . '>'.
                            '<span class="badge pull-right"><i class="fa fa-plus"></i></span>'.
                             $cat->name .
                        '</a>
                    </h4>
                </div>'.
                '<div id=' .$cat->slug.$cat->id . ' class="panel-collapse collapse">'.
                    '<div class="panel-body">
                        <ul>'.
                            categoryRecursive($subCats).
                        '</ul>
                    </div>
                </div>
            </div>';
        }else {
            $result .= '<li><a href='. route('category.index', ['slug' => $cat->slug, 'id' => $cat->id]) .'>'. $cat->name .'</a></li>';
        }
    } 
    return $result;
}

@endphp

<div class="left-sidebar">
    <h2>Category</h2>
    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
        @foreach ($categories as $category)
            <div class="panel panel-default">
                @php
                    $subCategories = App\Category::where('parent_id', $category->id)->get();
                @endphp
                @if ( count($subCategories) > 0 )
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordian" href="#{{ $category->slug.$category->id }}">
                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                {{ $category->name }}
                            </a>
                        </h4>
                    </div>
                    <div id="{{ $category->slug.$category->id }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                {!! categoryRecursive($subCategories) !!}
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="{{ route('category.index', ['slug' => $category->slug, 'id' => $category->id]) }}">{{ $category->name }}</a></h4>
                    </div>
                @endif
                
            </div>
        @endforeach
        
        
    </div><!--/category-products-->

    {{-- <div class="brands_products"><!--brands_products-->
        <h2>Brands</h2>
        <div class="brands-name">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
                <li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                <li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
                <li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
                <li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
                <li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
                <li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
            </ul>
        </div>
    </div><!--/brands_products--> --}}
    
    <div class="price-range"><!--price-range-->
        <h2 id='test1'>Price Range</h2>
        <div class="well text-center">
             <input type="text" class="span2" value="" data-slider-min={{ $minPrice }} data-slider-max={{ $maxPrice }} data-slider-step="5" data-slider-value="[{{ $minPrice }},{{ $maxPrice }}]" id="sl2" ><br />
             <b class="pull-left">{{ number_format($minPrice) ?? 0 }} đ</b> <b class="pull-right">{{ number_format($maxPrice) ?? 0 }} đ</b>
        </div>
    </div><!--/price-range-->
    
    <div class="shipping text-center"><!--shipping-->
        <img src="images/home/shipping.jpg" alt="" />
    </div><!--/shipping-->

</div>

