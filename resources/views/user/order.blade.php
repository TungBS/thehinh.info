@extends('layouts.app_master_user')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/user.min.css') }}">
@stop
@section('content')
    <section>
        <div class="title">Chi tiết đơn hàng #{{ $transaction->id }}</div>
        <div class="row">
            <div class="col-4">
                <h5>Thông tin người nhận</h5>
                <div class="box">
                    <p>Khách hàng: <b>{{ $transaction->user->name ?? "[N\A]" }}</b></p>
                    <p>Số điện thoại: <span>{{ $transaction->tst_phone }}</span></p>
                    <p>Mail: <span>{{ $transaction->tst_email }}</span></p>
                </div>
            </div>
            <div class="col-4">
                <h5>Địa chỉ giao hàng</h5>
                <div class="box">
                    <p>Tỉnh/Th.Phố: 
                        <span>
                            @foreach($locations as $location)
                                @if($location -> id == $transaction -> tst_city && $location -> type == 1)
                                    {{$location -> name}}
                                @endif
                            @endforeach
                        </span></p>
                    <p>Quận/Huyện: <span>
                            @foreach($locations as $location)
                                @if($location -> id == $transaction -> tst_district && $location -> type == 2)
                                    {{$location -> name}}
                                @endif
                            @endforeach
                        </span></p>
                    <p>Phường/Xã: 
                        <span>
                            @foreach($locations as $location)
                                @if($location -> id == $transaction -> tst_ward && $location -> type == 3)
                                    {{$location -> name}}
                                @endif
                            @endforeach
                        </span></p>
                    <p>Số nhà: <span>{{ $transaction->tst_address }}</span></p>
                    <!-- <p>Phí vận chuyển : <span>0 đ</span></p> -->
                </div>
            </div>
            <div class="col-4">
                <h5>Hình thức thanh toán</h5>
                <div class="box">
                    <p>Hình thức: <b>Giao hàng nhận tiền</b></p>
                    <p>Tổng tiền: <b>{{ number_format($transaction->tst_total_money,0,',','.') }} VNĐ</b></p>
                </div>
            </div>
        </div>
        <div class="content">
            <h4>Thông tin sản phẩm</h4>
            @include('user.include._inc_list_product_order')
            <div>
                <a href="{{ route('get.user.transaction') }}" class="btn btn-primary js-"><i class="la la-angle-double-left"></i> Quay lại đơn hàng</a>
                @if ($transaction->tst_status != -1)
                    <a href="{{ route('get.user.tracking_order', $transaction->id) }}" class="btn btn-primary js-">Theo dõi đơn hàng <i class="la la-angle-double-right"></i></a>
                @endif
            </div>
        </div>
    </section>
@stop
