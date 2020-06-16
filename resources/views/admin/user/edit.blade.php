@extends('layouts.admin')
@section('title', 'Slider')

@section('css')
  <link href="{{ asset('vendors\select2\select2.min.css') }}" rel="stylesheet" />
@endsection

@section('js')
  <script src="{{ asset('vendors\select2\select2.min.js') }}"></script>
  <script src="{{ asset('admins\user\add\add.js') }}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @include('partials.content-header',  ['name' => 'User', 'key' => 'Edit'])
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
              <form action="{{ route('users.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="">Tên</label>
                  <input type="text"
                    class="form-control" name="name" placeholder="Nhập tên" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                  <label for="">Email</label>
                  <input type="text"
                    class="form-control" name="email" placeholder="Nhập email"  value="{{ $user->email }}">
                </div>
                <div class="form-group">
                  <label for="">Tên</label>
                  <input type="password"
                    class="form-control" name="password" placeholder="Nhập password" >
                </div>
                <div class="form-group">
                  <label for="">Vai trò</label>
                  <select name="role_id[]" class="form-control select-role" multiple>
                    <option value=""></option>
                    @if ($roles)
                        @foreach($roles as $role)
                        <option
                          {{ $user->roles()->where('role_id', $role->id)->first()['id'] == $role->id ? 'selected' : '' }} 
                          value="{{ $role->id }}">{{  $role->name }}
                        </option>
                        @endforeach
                    @endif
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


