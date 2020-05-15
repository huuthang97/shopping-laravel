@extends('layouts.admin')
@section('title', 'Edit Product')

@section('css')
<link href="{{ asset('vendors\select2\select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admins\product\add\add.css') }}" rel="stylesheet" />
<script src="{{ asset('ckeditor\ckeditor.js') }}"></script>

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @include('partials.content-header',  ['name' => 'Product', 'key' => 'Edit'])
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <form action="{{ route('products.update', ['id' => $product->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Tên sản phẩm</label>
                      <input type="text"
                        class="form-control" name="name" placeholder="Nhập tên sản phẩm" value="{{ $product->name }}">
                    </div>
                    <div class="form-group">
                      <label for="">Giá</label>
                      <input type="number"
                        class="form-control" name="price" placeholder="Nhập giá" value="{{ $product->price }}">
                    </div>
                    <div class="form-group">
                      <label for="">Ảnh đại diện</label>
                      <input type="file" class="form-control-file" name="avatar" >
                      <div class="mt-3">
                        <img src="{{ asset($product->feature_image_path) }}" alt="" width="100">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="">Ảnh chi tiết</label>
                      <input type="file"
                        class="form-control-file" name="photos[]" multiple>
                        @if ($product->productImages)
                        <div class="row">
                          @foreach ($product->productImages as $img)
                            <div class="col-md-3 mt-3">
                              <img src="{{ asset($img->image_path) }}" alt="" width="100">
                            </div>
                            <div class="col-md-3 mt-3">
                              <img src="{{ asset($img->image_path) }}" alt="" width="100">
                            </div>
                            <div class="col-md-3 mt-3">
                              <img src="{{ asset($img->image_path) }}" alt="" width="100">
                            </div>
                            <div class="col-md-3 mt-3">
                              <img src="{{ asset($img->image_path) }}" alt="" width="100">
                            </div>
                          @endforeach
                        </div>
                        @endif
                     
                    </div>
                    <div class="form-group">
                      <label for="">Chọn danh mục</label>
                      <select class="form-control category" name="parent_id" >
                        <option value={{ 0 }}>Danh mục cha</option>
                        {!! $htmlOption !!}
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Nhập tags cho sản phẩm</label>
                      <select class="form-control tag" name="tags[]" multiple>
                        @if ($product->tags)
                        @foreach ($product->tags as $tag)
                            <option value="{{ $tag->name }}" selected>{{ $tag->name }}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group ">
                    <label for="comment">Nội dung:</label>
                    <textarea id=""  class="form-control" rows="5" name="content" >{{ $product->name }}</textarea>
                  </div>
                  <script>
                    CKEDITOR.replace( 'content' );
                  </script>
                </div>
                <div class="col-md-12">
                  <button type="submit" class="btn btn-success">Lưu</button>
                </div>
              
            </div>
          </form>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
  <script src="{{ asset('vendors\select2\select2.min.js') }}"></script>
  <script src="{{ asset('admins\product\add\add.js') }}"></script>
@endsection
