@extends('layouts.admin')
@section('title', 'Slider')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @include('partials.content-header', ['name'=>'Slider', 'key'=>'List'])
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
                    <th scope="col">Tên danh mục</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  {{--  @foreach ($categories as $category)
                    <tr>
                      <th scope="row">{{ $category->id }}</th>
                      <td>{{ $category->name }}</td>
                      <td>
                        <a class="btn btn-default" href="{{ route('categories.edit', ['id' => $category->id]) }}" type="button">Sửa</a>
                        <a class="btn btn-danger"  href="{{ route('categories.delete', ['id' => $category->id]) }}" type="button">Xóa</a>
                      </td>
                    </tr>    
                  @endforeach  --}}
                </tbody>
              </table>
            </div>
            <div class="col-md-12">
              {{--  {{ $sliders->links() }}  --}}

            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


