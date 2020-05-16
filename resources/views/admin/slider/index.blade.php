@extends('layouts.admin')
@section('title', 'Slider Edit')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @include('partials.content-header', ['name'=>'Slider', 'key'=>'Edit'])
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <a href="{{ route('sliders.create') }}" type="button" class="btn btn-success float-right mb-2">Add</a>
            </div>
            <div class="col-md-12">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên Slider</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                   @foreach ($sliders as $slider)
                    <tr>
                      <th scope="row">{{ $slider->id }}</th>
                      <td>{{ $slider->name }}</td>
                      <td>
                        <img src="{{ asset($slider->image_path) }}" width="100">
                      </td>
                      <td>{{ $slider->description }}</td>
                      <td>
                        <a class="btn btn-default" href="{{ route('sliders.edit', ['id' => $slider->id]) }}" type="button">Sửa</a>
                        <a class="btn btn-danger"  href="{{ route('sliders.delete', ['id' => $slider->id]) }}" type="button">Xóa</a>
                      </td>
                    </tr>    
                  @endforeach 
                </tbody>
              </table>
            </div>
            <div class="col-md-12">
               {{ $sliders->links() }} 

            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


