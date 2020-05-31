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

      });
  </script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @include('partials.content-header',  ['name' => 'Role', 'key' => 'Edit'])
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
              <form action="{{ route('permissions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label >Module</label>
                  <select class="form-control" name="module" >
                    <option value="">--Chọn module--</option>
                    @foreach (config('permissions.modules') as $module)
                    <option value="{{ $module }}"> {{ $module }} </option>
                    @endforeach
                  </select>
                </div>
                <!--Card-->
                <div class="card text-white bg-light  mb-3" style="">
                  <!-- Card-header -->
                  <div class="card-header bg-success">
                    <div class="form-check col-md-3">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-parent" >
                        Check all
                      </label>
                    </div>
                  </div>
                  <!-- End-Card-header -->
                  <div class="card-body row">
                    @foreach (config('permissions.module_childrent') as $module_childrent)
                      <div class="form-check col-md-3">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input" name="module_childrent[]" value="{{ $module_childrent }}" >
                          {{ $module_childrent }}
                        </label>
                      </div>
                    @endforeach
                  </div>
                </div>
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


