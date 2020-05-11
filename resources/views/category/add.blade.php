@extends('layouts.admin')
@section('title', 'Trang chủ')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @include('partials.content-header',  ['name' => 'Category', 'key' => 'Add'])
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="">Tên danh mục</label>
                  <input type="text"
                    class="form-control" name="name" placeholder="Nhập danh mục">
                </div>
                <div class="form-group">
                  <label for="">Chọn danh mục cha</label>
                  <select class="form-control" name="parent_id" >
                    <option value={{ 0 }}>Danh mục cha</option>
                    {!! $htmlOption !!}
                  </select>
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


