@extends('layouts.app_master_frontend');
@section('css')
	<style>
        <?php $style = file_get_contents('css/product_detail_insights.min.css');echo $style;?>
    </style>
@stop
@section('content')
	
    <div class="container">
        <div class="breadcrumb">
                    <ul>
                        <li>
                            <a itemprop="url" href="http://localhost:8080/frameLaravel/thehinh.vn/public/" title="Trang chủ"><span itemprop="title">Trang chủ</span></a>
                        </li>
                        <li>
                            <a itemprop="url" href="{{ route('get.product.list')}}" title="Sản phẩm"><span itemprop="title">Sản phẩm</span></a>
                        </li>

                        <li>
                            <a itemprop="url" href="" title="Chi tiết sản phẩm"><span itemprop="title">{{ $product->pro_name}}</span></a>
                        </li>

                    </ul>
                </div>
        <div class="card">
            <div class="card-body info-detail">
                <div class="left">
            {{--                    @include('frontend.pages.product_detail.include._inc_album')--}}
                    <a href="{{ route('get.product.detail',$product->pro_slug . '-'.$product->id ) }}" title=""
                       class="">
                        <img alt="" style="max-width: 100%" src="{{ pare_url_file($product->pro_avatar) }}"
                             class="lazyload">
                    </a>
                </div>
                <div class="right" id="product-detail" data-id="{{ $product->id }}">
                    <h1>{{ $product -> pro_name}}</h1>
                    <div class="right__content">
                        <div class="info">

                            <div class="prices">    
                                @if ($product->pro_sale)
                                    <p>Giá niêm yết: 
                                        <span class="value">{{ number_format($product->pro_price,0,',','.')}} đ</span></p>
                                    @php
                                        $price = (100 - $product->pro_sale) * $product->pro_price /100;
                                    @endphp
                                    <p>
                                    Giá bán: <span class="value price-new">{{ number_format($price,0,',','.')}} đ</span>
                                    <span class="sale">-{{ $product->pro_sale}}%</span>
                                </p>
                                @else
                                    <p>
                                    Giá bán: <span class="value price-new">{{ number_format($product->pro_price,0,',','.')}} đ</span>
                                </p>
                                @endif
                                <p>
                                    <span>Lượt xem :&nbsp</span>
                                    <span>{{ $product->pro_view}}</span>
                                </p>
                            </div>
                            <div class="btn-cart">
                                <a href="{{ route('get.shopping.add', $product->id)}}" title="Thêm vào giỏ hàng" onclick="add_cart_detail('17617',0);" class="muangay">
                                    <span>Mua ngay</span>
                                    <span>Hotline: 0337857855</span>
                                </a>
                                <a href="{{ route('ajax_get.user.add_favourite', $product->id)}}"
                                 title="Thêm sản phẩm yêu thích" class="muatragop {{ !\Auth::id() ? 'js-show-login' : 'js-add-favourite'}}">
                                    <span>Yêu thích</span>
                                    <span>Sản phẩm</span>
                                </a>
                            </div>
                            <div class="infomation">
                                <h2 class="infomation__title">Thông tin sản phẩm</h2>
                                <div class="infomation__group">

                                    <div class="item">
                                        <p class="text1">Danh mục:</p>
                                        <h3 class="text2">
                                            @if (isset($product->category->c_name))
                                                <a href="{{ route('get.product.list', $product->category->c_slug).'-'.$product->pro_category_id}}">{{ $product->category->c_name}}</a>
                                            @else
                                            "[N\A]"
                                            @endif
                                        </h3>
                                    </div>
                                    <div class="item">
                                        <p class="text1">Xuất xứ:</p>
                                        <h3 class="text2">{{ $product->getCountry($product->pro_country)}}</h3>
                                    </div>
                                    <div class="item">
                                        <p class="text1">Năng lượng:</p>
                                        <h2 class="text2">{{ $product->pro_energy}}</h2>
                                    </div>
                                    <div class="item">
                                        <p class="text1">Số lần dùng:</p>
                                        <h3 class="text2">{{ $product->pro_resistant}}</h3>
                                    </div>
                                </div>
                            </div>
                            @if (isset($product->keywords))
                            <div class="infomation" style="margin-top: 20px">
                                <h2 class="infomation__title">Từ khóa</h2>
                                <div class="infomation__group">
                                    <div class="item">
                                    @foreach($product->keywords as $keyword)
                                        <a href="" style="border: 1px solid #E91E63;display: inline-block;front-size: 13px;padding: 0 5px; border-radius: 5px;margin-right: 10px;color: #E91E63">{{ $keyword->k_name}}</a>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div> 
                    </div>
                </div>
            </div>

            <style>
                #assignment_group_container {
                  overflow-x: hidden;
                  white-space: nowrap;
                }
                
                #assignment_group_container figure {
                  display: inline-block;
                }
            </style>
            <div class="span12" id="assignment_group_container">
                @foreach($images as $item)
                  <figure id="Ab_Crunch_Machine">
                    <img alt="50" width="100" height="100" src="{{ pare_url_file($item->pi_slug) }}" />
                  </figure>
                @endforeach
                <!-- repeat the figure... -->
            </div>
            

            <div class="card">
                @include('frontend.pages.product_detail.include._inc_content')                       
            </div>
            
            <div class="card">
                @include('frontend.pages.product_detail.include._inc_ratings')
            </div>
            <div class="card-body product-des">
                <div class="left">
                    <div class="tabs">
                        <div class="tabs__content">
                            <div class="product-five">
                                <div class="bot js-product-5 owl-carousel owl-theme owl-custom">
                                    @foreach($productsSuggests as $product)
                                        <div class="item">
                                            @include('frontend.components.product_item', ['product' => $product])
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
	<script src="{{ asset('js/product_detail.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        var ROUTE_COMMENT = '{{ route('ajax_post.comment') }}';
        var CSS = "{{ asset('css/product_detail.min.css') }}";
        var URL_CAPTCHA = '{{ route('ajax_post.captcha.resume') }}'
    </script>
@stop 