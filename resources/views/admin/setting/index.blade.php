@extends('layouts.admin')
@section('title', 'Settings')

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="{{ asset('admins\slider\index\index.js') }}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @include('partials.content-header', ['name'=>'Setting', 'key'=>'List'])
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-11 mb-3">
              <div class="btn-group float-right mb-2">
                <button type="button" class="btn btn-success dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Add Setting
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{ route('settings.create') . '?type=text' }}">Text</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('settings.create') . '?type=textarea' }}">Textarea</a>
                </div>
              </div>
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
                   {{-- @foreach ($sliders as $slider)
                    <tr>
                      <th scope="row">{{ $slider->id }}</th>
                      <td>{{ $slider->name }}</td>
                      <td>
                        <img src="{{ asset($slider->image_path) }}" width="100">
                      </td>
                      <td>{{ $slider->description }}</td>
                      <td>
                        <a class="btn btn-default" href="{{ route('sliders.edit', ['id' => $slider->id]) }}" type="button">Sửa</a>
                        <a class="btn btn-danger delete-action"  href="{{ route('sliders.delete', ['id' => $slider->id]) }}" type="button">Xóa</a>
                      </td>
                    </tr>    
                  @endforeach  --}}
                </tbody>
              </table>
            </div>
            <div class="col-md-12">
               {{-- {{ $sliders->links() }}  --}}

            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


