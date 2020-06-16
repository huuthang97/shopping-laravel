@extends('layouts.admin')
@section('title', 'Trang chủ')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @include('partials.content-header',  ['name' => 'Menu', 'key' => 'Edit'])
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <form action="{{ route('menus.update', ['id' => $menu->id]) }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="">Tên menu</label>
                  <input type="text"
                    class="form-control" name="name" placeholder="Nhập menu" value="{{ $menu->name }}">
                </div>
                <div class="form-group">
                  <label for="">Chọn menu cha</label>
                  <select class="form-control" name="parent_id" >
                    <option value={{ 0 }}>Menu cha</option>
                    {!! $option !!}
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


