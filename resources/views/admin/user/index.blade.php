@extends('layouts.admin')
@section('title', 'User')

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="{{ asset('admins\slider\index\index.js') }}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @include('partials.content-header', ['name'=>'User', 'key'=>'Edit'])
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <a href="{{ route('users.create') }}" type="button" class="btn btn-success float-right mb-2">Add</a>
            </div>
            <div class="col-md-12">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                   @foreach ($users as $user)
                    <tr>
                      <th scope="row">{{ $user->id }}</th>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>
                        <a class="btn btn-default" href="{{ route('users.edit', ['id' => $user->id]) }}" type="button">Sửa</a>
                        <a class="btn btn-danger delete-action"  href="{{ route('users.delete', ['id' => $user->id]) }}" type="button">Xóa</a>
                      </td>
                    </tr>    
                  @endforeach 
                </tbody>
              </table>
            </div>
            <div class="col-md-12">
               {{ $users->links() }} 

            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


