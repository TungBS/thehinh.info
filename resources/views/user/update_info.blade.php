@extends('layouts.app_master_user')
@section('css')
    <style>
        <?php $style = file_get_contents('css/user.min.css');echo $style;?>
    </style>
@stop
@section('content')
    <section class="py-lg-5" style="background: white; padding: 20px">
        <div class="row mb-5">
            <div class="col-sm-12">
                <form action="" method="POST">
                @csrf
            <div class="form-group">
                <label for="">Tên người dùng</label>
                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="">Số điện thoại</label>
                <input type="number" name="phone" class="form-control" value="{{ Auth::user()->phone }}" placeholder="">
            </div>
            <div class="form-group">
                <label for="">Tỉnh/TP</label>
                <input type="text" name="city" class="form-control" value="{{ Auth::user()->city }}" placeholder="Tỉnh/TP">
            </div>
            <div class="form-group">
                <label for="">Quận/Huyện</label>
                <input type="text" name="district" class="form-control" value="{{ Auth::user()->district }}" placeholder="Quận/Huyện">
            </div>
            <div class="form-group">
                <label for="">Phường/Xã</label>
                <input type="text" name="ward" class="form-control" value="{{ Auth::user()->ward }}" placeholder="Phường/Xã">
            </div>
            <div class="form-group">
                <label for="">Địa chỉ</label>
                <input type="text" name="address" class="form-control" value="{{ Auth::user()->address }}" placeholder="Địa chỉ">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
            </div>
         </div>
    </section>

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
        })
    })
</script>
    
@stop