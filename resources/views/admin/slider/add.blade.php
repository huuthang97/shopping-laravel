@extends('layouts.admin')
@section('title', 'Slider')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @include('partials.content-header',  ['name' => 'Slider', 'key' => 'Add'])
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
            </div>
            <div class="col-md-6">
              <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="">Tên slider</label>
                  <input type="text"
                    class="form-control" name="name" placeholder="Nhập tên slider" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                  <label for="">Mô tả slider</label>
                  <textarea name="des" class="form-control"  rows="4">{{ old('des') }}</textarea>
                </div>
                <div class="form-group">
                  <label for="">Ảnh</label>
                  <input type="file"
                    class="form-control-file" name="photo">
                </div>
                <button type="submit" class="btn btn-success">Lưu</button>
              </form>
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


