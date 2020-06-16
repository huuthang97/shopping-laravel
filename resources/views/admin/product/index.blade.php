@extends('layouts.admin')
@section('title', 'Product')

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="{{ asset('admins\product\index\index.js') }}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      @include('partials.content-header', ['name'=>'Product', 'key'=>'List'])
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <a href="{{ route('products.create') }}" type="button" class="btn btn-success float-right mb-2">Add</a>
            </div>
            <div class="col-md-12">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên danh mục</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($products as $product)
                    <tr>
                      <th scope="row">{{ $product->id }}</th>
                      <td>{{ $product->name }}</td>
                      <td>{{ $product->price }}</td>
                      <td>
                        <img class="img-fluid" src="{{ asset($product->feature_image_path) }}" alt="" width="100" height="auto">
                        </td>
                      <td>{{ $product->category->name }}</td>
                      
                      <td>
                        <a class="btn btn-default" href="{{ route('products.edit', ['id' => $product->id]) }}" type="button">Sửa</a>
                        <a class="btn btn-danger delete-action"  href="{{ route('products.delete', ['id' => $product->id]) }}" type="button">Xóa</a>
                      </td>
                    </tr>    
                  @endforeach
                </tbody>
              </table>
            </div>
            <div class="col-md-12">
              {{ $products->links() }}

            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


