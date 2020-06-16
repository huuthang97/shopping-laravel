@extends('layouts.admin')
@section('title', 'Settings')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @include('partials.content-header',  ['name' => 'Setting', 'key' => 'Add'])
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
              <form action="{{ route('settings.store') . '?type=' . request()->type}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="">Config key</label>
                  <input type="text"
                    class="form-control" name="config_key" placeholder="Nhập tên config key" value="{{ old('config_key') }}">
                </div>
                <div class="form-group">
                  <label for="">Config value</label>
                  @if (request()->type === 'textarea')
                    <textarea name="config_value" class="form-control"  rows="4">{{ old('config_value') }}  </textarea>
                  @else
                    <input type="text" class="form-control" name="config_value" 
                     value="{{ old('config_value') }}">
                  @endif
                  
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


