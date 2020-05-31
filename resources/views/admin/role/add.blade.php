@extends('layouts.admin')
@section('title', 'Role')

@section('css')
  <link href="{{ asset('vendors\select2\select2.min.css') }}" rel="stylesheet" />
@endsection

@section('js')
  <script src="{{ asset('vendors\select2\select2.min.js') }}"></script>
  <script src="{{ asset('admins\user\add\add.js') }}"></script>
  <script>
      $( document ).ready(function() {

        $('.form-check-parent').click(function () {
          $(this).parents('.card').find('.form-check-input').prop('checked', $(this).prop('checked'));
        });

        $('.check_all').click(function () {
          $(this).parents('form').find('.form-check-input').prop('checked', $(this).prop('checked'));
        });

      });
  </script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @include('partials.content-header',  ['name' => 'Role', 'key' => 'Add'])
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
            <div class="col-md-12">
              <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label >Tên vai trò</label>
                  <input type="text"
                    class="form-control" name="name" placeholder="Nhập tên vai trò" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                  <label >Mô tả vai trò</label>
                  <textarea class="form-control" name="display_name" placeholder="Nhập mô tả" rows="4" >{{ old('display_name') }}
                  </textarea>
                </div>
                <div class="col-md-12 mb-2">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="check_all">
                      Check all
                    </label>
                  </div>
                </div>
                <!--Card-->
                @foreach ($permissions as $permission)
                  <div class="card text-white bg-light  mb-3" style="">
                    <!-- Card-header -->
                    <div class="card-header bg-success">
                      <div class="form-check col-md-3">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-parent" >
                          {{ $permission->name }}
                        </label>
                      </div>
                    </div>
                    <!-- End-Card-header -->
                    <div class="card-body row">
                      @foreach ($permission->permissionChildrent as $item)
                        <div class="form-check col-md-3">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="permission_id[]" value="{{ $item->id }}" >
                            {{ $item->name }}
                          </label>
                        </div>
                      @endforeach
                    </div>
                  </div>
                @endforeach
                <!--End-Card-->
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


