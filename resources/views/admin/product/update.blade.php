
@extends('layouts.app_master_admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Cập nhật sản phẩm</h1>
    </section>
    
    <section class="content">
        <div class="row">
            @include('admin.product.form')
        </div>        
    </section>

@stop