
@extends('layouts.app_master_admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Thêm mới bài viết</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            @include('admin.article.form')
        </div>        
    </section>
@stop