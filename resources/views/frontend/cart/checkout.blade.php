@extends('layouts.frontend-no-sidebar')

@section('title', 'Giỏ hàng')
    
@section('content')
    <div class="container">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        <div class="shopper-informations">
            <div class="row">
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <div class="col-sm-3">
                        <div class="shopper-info">
                            <table class="table table-condensed total-result">
                                    <tr>
                                        <td>Số lượng</td>
                                        <td>{{ session()->get('cart')['total_qty'] }}</td>
                                    </tr>
                                    <tr>
                                        <td>Thành tiền</td>
                                        <td><b>{{ number_format(session()->get('cart')['total']) }} đ</b></td>
                                    </tr>
                                    
                                </table>
                        </div>
                    </div>
                    <div class="col-sm-5 clearfix">
                        <div class="bill-to">
                            <div class="">
                                    <div class="form-group">
                                        <label for="name">Fullname:</label>
                                        <input type="text" name="name" required maxlength=100 class="form-control" id="name" placeholder="Hữu Thắng">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone:</label>
                                        <input type="text" name="phone" required class="form-control" max=11 id="phone" placeholder="0377499804">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" name="email" maxlength=100 class="form-control" id="email" placeholder="huuthangk49hce1@gmail.com">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address:</label>
                                        <input type="text" name="address" required maxlength=150 class="form-control" id="address" placeholder="370/2 Hà Huy Tập - phường Hòa Khê - quận Thanh Khê - Đà Nẵng">
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="note">Ghi chú</label>
                            <textarea name="note" class="form-control" rows="5" maxlength="3000" id="note"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Thanh toán</button>
                    </div>
                </form>				
            </div>
        </div>
    </div>
@endsection

