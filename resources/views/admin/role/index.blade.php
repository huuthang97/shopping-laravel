@extends('layouts.admin')
@section('title', 'Role')

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="{{ asset('admins\slider\index\index.js') }}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @include('partials.content-header', ['name'=>'Role', 'key'=>'List'])
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <a href="{{ route('roles.create') }}" type="button" class="btn btn-success float-right mb-2">Add</a>
            </div>
            <div class="col-md-12">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Tên hiển thị</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                   @foreach ($roles as $role)
                    <tr>
                      <th scope="row">{{ $role->id }}</th>
                      <td>{{ $role->name }}</td>
                      <td>{{ $role->display_name }}</td>
                      <td>
                        <a class="btn btn-default" href="{{ route('roles.edit', ['id' => $role->id]) }}" type="button">Sửa</a>
                        <a class="btn btn-danger delete-action"  href="{{ route('roles.delete', ['id' => $role->id]) }}" type="button">Xóa</a>
                      </td>
                    </tr>    
                  @endforeach 
                </tbody>
              </table>
            </div>
            {{-- <div class="col-md-12">
               {{ $roles->links() }} 

            </div> --}}
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


