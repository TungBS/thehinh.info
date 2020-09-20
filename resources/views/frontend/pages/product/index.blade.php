@extends('layouts.app_master_frontend')
@section('css')
     <style>
        <?php $style = file_get_contents('css/product_insights.min.css');echo $style;?>
        .filter-tab .active a {
            color: red;
        }
    </style>
@stop
@section('content')
    <div class="container">
        <div class="product-list">
            <div class="left">
                @include('frontend.pages.product.include._inc_sidebar')
            </div>
            <div class="right">

                            <div class="filter-tab">
                                <ul>
                                    @for($i = 1; $i <= 3; $i++)
                                        @if($i == 1)
                                            <li>
                                                <a href="{{ request()->fullUrlWithQuery(['price'=> $i ]) }}"><span>Giá dưới {{$i * 1}} triệu </span></a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ request()->fullUrlWithQuery(['price'=> $i ]) }}"><span>Giá từ {{$i * 1}} - {{($i + 1) * 1}} triệu </span></a>
                                            </li>
                                        @endif
                                    @endfor
                                    <li>
                                        <a href="{{ request()->fullUrlWithQuery(['price'=> 4]) }}"><span>Giá trên 4 triệu</span></a>
                                    </li>
                                </ul>
                            </div>
                <div class="order-tab">
                    <span class="total-prod">Tổng số: {{ $products->total() }} Sản phẩm</span>
                </div>
                <div class="group">
                    @foreach($products as $product)
                        @include('frontend.components.product_item', ['product' => $product])
                    @endforeach
                </div>
                <div style="display: block;">
                    {!! $products->appends($query ?? [])->links() !!}
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        var CSS = "{{ asset('css/product_search.min.css') }}";
    </script>
    <script type="text/javascript">
        <?php $js = file_get_contents('js/product_search.js');echo $js;?>
    </script>
@stop
