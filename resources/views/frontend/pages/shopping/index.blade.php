@extends('layouts.app_master_frontend')
@section('css')
<link rel="stylesheet" href="{{ asset('css/cart.min.css') }}">
<style type="text/css">
    .btn-action {
    font-size: 12px;
    padding: 0 10px;
    border: 1px solid #E91E63;
    background: #E91E63;
    color: white;
    margin-top: 5px;
    display: inline-block;
    border-radius: 10px;     
    }
    .btn-action-delete {
    font-size: 12px;
    padding: 0 10px;
    border: 1px solid #888;
    background: #888;
    color: white;
    margin-top: 5px;
    display: inline-block;
    border-radius: 10px;   
    }
</style>
@stop
@section('content')
<div class="container cart">
    <div class="left">
        <div class="list">
            <div class="title">THÔNG TIN GIỎ HÀNG</div>
            <div class="list__content">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shopping as $key => $item)
                        <tr>
                            <td>
                                <a href="{{ route('get.product.detail',\Str::slug($item->name).'-'.$item->id) }}" title="{{ $item->name}}" class="avatar image contain">
                                <img alt="" src="{{ pare_url_file($item->options->image)}}" class="lazyload">
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('get.product.detail',\Str::slug($item->name).'-'.$item->id) }}"><strong>{{ $item->name}}</strong></a>
                            </td>
                            <td>
                                <p><b>{{ number_format($item->price,0,',','.')}} đ</b></p>
                                <p>       
                                    @if ($item->options->price_old)
                                    <span style="text-decoration: line-through;">{{ number_format(number_price($item->options->price_old),0,',','.')}} đ</span>
                                    <span class="sale">- {{ $item->options->sale}} %</span>
                                    @endif
                                </p>
                            </td>
                            <td>
                                <div class="qty_number">
                                    <input type="text" min="1" class="" name="quantity_14692" value="{{ $item->qty}}" id="">
                                    <p data-price="{{ $item->price}}" data-url="{{ route('ajax_get.shopping.update', $key)}}" data-id-product="{{ $item->id}}">
                                        <span class="js-increase">+</span>
                                        <span class="js-reduction">-</span>
                                    </p>
                                </div>
                                <a href="{{ route('get.shopping.delete', $key)}}" class="js-delete-item btn-action-delete"><i class="la la-trash"></i>Xóa</a>
                            </td>
                            <td>
                                <span class="js-total-item">{{ number_format($item->price * $item->qty,0,',','.') }} đ</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p style="float: right; margin-top: 20px">
                    Tổng tiền : <b id="sub-total">{{ \Cart::subtotal(0) }} đ</b>
                </p>
            </div>
        </div>
    </div>
    <div class="right">
        <div class="customer">
            <div class="title">THÔNG TIN ĐẶT HÀNG</div>
            <div class="customer__content">
                <form class="from_cart_register" action="{{route('post.shopping.pay')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name" >Họ và tên <span class="cRed">(*)</span></label>
                        <input name="tst_name" id="name" required="" value="{{ get_data_user('web','name')}}" type="text" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label for="phone">Điện thoại <span class="cRed">(*)</span></label>
                        <input name="tst_phone" id="phone" required="" value="{{ get_data_user('web','phone')}}" type="number" class="form-control" >
                    </div>


                <!-- location -->
                    <div class="form-group">
                        <label for="exampleInputPassword1">Tỉnh thành</label>
                        <select class="form-control form-control-sm js_location" name="tst_city" data-type="city" required>
                            <option value="">Chọn tỉnh thành</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputPassword1">Quận huyện</label>
                        <select class="form-control form-control-sm js_location" name="tst_district" data-type="district" id="district" required>
                            <option value="">Chọn quận huyện</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputPassword1">Phường Xã</label>
                        <select class="form-control form-control-sm" name="tst_ward" data-type="wards" id="wards" required>
                            <option required value="">Chọn phường xã</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="address">Địa chỉ <span class="cRed">(*)</span></label>
                        <input name="tst_address" id="address" required="" value="{{ get_data_user('web','address')}}"  type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email <span class="cRed">(*)</span></label>
                        <input name="tst_email" id="email" required="" value="{{ get_data_user('web','email')}}" type="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="note">Ghi chú thêm</label>
                        <textarea name="tst_note" id="note" cols="3" style="min-height: 100px;" rows="2" class="form-control"></textarea>
                    </div>
                    <div class="btn-buy">
                        <button class="buy1 btn btn-purple" type="submit" 
                            <?php
                                echo (\Cart::count() ? '' : 'disabled style="cursor: not-allowed"');
                            ?>
                        >
                        Xác nhận
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
<script src="{{ asset('js/cart.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="https://codeseven.github.io/toastr/build/toastr.min.js"></script>
<script type="text/javascript">
    $(function() {
    $(".js-delete-item").click( function(event){
    event.preventDefault();
    let $this = $(this);
    let url    = $this.attr('href');
    
    if(url) {
        $.ajax({
            url: url,
        }).done(function( results ) {
            toastr.success(results.messages);
            $this.parents('tr').remove();
            $("#sub-total").text(results.totalMoney+ " đ");
       });
    }
    })
    
    $('.js-increase').click(function (event) {
    event.preventDefault();
    let $this = $(this);
    let $input = $this.parent().prev();
    let number = parseInt($input.val());
    if (number >= 10) {
        toastr.warning("Mỗi sản phẩm chỉ mua tối 10 sản phẩm / 1 đơn hàng");
        return false;
    }
    
    let price = $this.parent().attr('data-price');
    let URL = $this.parent().attr('data-url');
    let productID = $this.parent().attr("data-id-product");
    
    number = number + 1;
    $.ajax({
        url: URL,
        data: {
            qty        : number,
            idProduct  : productID
        }
    }).done(function( results ) {
        if (typeof results.totalMoney !== "undefined") {
            $input.val(number);
            $("#sub-total").text(results.totalMoney+ " đ");
            toastr.success(results.messages);
            $this.parents('tr').find(".js-total-item").text(results.totalItem +' đ');
        }else {
            $input.val(number - 1);
        }
    });
    })
    
    $('.js-reduction').click(function (event) {
    let $this  = $(this);
    let $input = $this.parent().prev();
    let number = parseInt($input.val());
    if (number <= 1) {
        toastr.warning("Số lượng sản phẩm phải >= 1");
        return false;
    }
    
    let URL       = $this.parent().attr('data-url');
    let productID = $this.parent().attr("data-id-product");
    
    
    number = number - 1;
    $.ajax({
        url: URL,
        data: {
            qty        : number,
            idProduct  : productID
        }
    }).done(function( results ) {
        if (typeof results.totalMoney !== "undefined") {
            $input.val(number);
            $("#sub-total").text(results.totalMoney+ " đ");
            toastr.success(results.messages);
            $this.parents('tr').find(".js-total-item").text(results.totalItem +' đ');
        }else {
            $input.val(number + 1);
        }
    });
    })
    })
</script>

<script type="text/javascript">
    // Xu ly Tinh - TP, Quận - Huyện, Xã - Phường
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".js_location").change(function(event){
            event.preventDefault();
            let route = '{{ route('ajax_get.location') }}'
            let $this = $(this);
            let type = $this.attr('data-type');
            let parentID  = $this.val();
            $.ajax({
                method: "GET",
                url: route,
                data: {type: type, parent: parentID}
            })
            .done(function(msg){
                if (msg.data) {
                    let html = '';
                    let element = '';
                    if (type == 'city') {
                        html = "<option value=''>Chọn quận huyện</option>";
                        element = '#district';
                    } else {
                        html = "<option value=''>Chọn phường xã</option>";
                        element = '#wards';
                    }

                    $.each(msg.data, function(index, value){
                        html += "<option value='"+value.id+"'>"+value.name+"</option>"
                    })

                    $(element).html('').append(html);
                }
            });

        });
    });
</script>
@stop