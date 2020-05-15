@extends('layouts.admin')
@section('title', 'Product')

@section('css')
<link href="{{ asset('vendors\select2\select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admins\product\add\add.css') }}" rel="stylesheet" />
<script src="{{ asset('ckeditor\ckeditor.js') }}"></script>

@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @include('partials.content-header',  ['name' => 'Product', 'key' => 'Add'])
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Tên sản phẩm</label>
                      <input type="text"
                        class="form-control" name="name" placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="form-group">
                      <label for="">Giá</label>
                      <input type="number"
                        class="form-control" name="price" placeholder="Nhập giá">
                    </div>
                    <div class="form-group">
                      <label for="">Ảnh đại diện</label>
                      <input type="file"
                        class="form-control-file" name="avatar" >
                    </div>
                    <div class="form-group">
                      <label for="">Ảnh chi tiết</label>
                      <input type="file"
                        class="form-control-file" name="photos[]" multiple>
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
                      <select class="form-control tag" name="tags[]" multiple></select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group ">
                    <label for="comment">Nội dung:</label>
                    <textarea id=""  class="form-control" rows="5" name="content"></textarea>
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
