<!DOCTYPE html>
<html lang="vi">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	<title>{{ $title_page ?? "Đồ án tốt nghiệp"}}</title>
	<meta name="robots" content="INDEX,FOLLOW"/>
	<link rel="stylesheet" type="text/css" href="https://codeseven.github.io/toastr/build/toastr.min.css">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	@yield('css')

	<!-- Thông Báo -->
	@if(session('toastr'))
		<script>
			var TYPE_MESSAGE = "{{session('toastr.type')}}";
			var MESSAGE = "{{session('toastr.message')}}";
		</script>
	@endif
	<style type="text/css">
		.text-danger {
			color: red;
			font-size: 11px
		}
	</style>
	

	<link rel="icon" href="{{ url('images/logoGym.png') }}" type="image/x-icon"/>	<!--thêm favicon vào thanh title website-->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('/css/app.css')  }}">	<!--thêm favicon vào thanh title website-->




</head>
<body>
	@include('frontend.components.header')
	@yield('content')
	@include('frontend.components.footer')
	<script>
		var DEVICE = '{{ device_agent()}}'
	</script>
	@yield('script')
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://codeseven.github.io/toastr/build/toastr.min.js"></script>
	<!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v7.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="110506877371094"
        theme_color="#13cf13"
        logged_in_greeting="Xin chào.. BST Gym hân hạnh được phục vụ!!"
        logged_out_greeting="Xin chào.. BST Gym hân hạnh được phục vụ!!">
      </div>
	<!-- Load Facebook SDK for JavaScript -->
</body>
</html>