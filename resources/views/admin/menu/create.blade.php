
@extends('layouts.app_master_admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Thêm mới danh mục bài viết</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <div class="box-body">
                   	<form role="form" action="" method="POST">
                  		@csrf
						                   		
                   		<div class="col-md-8">                			
					        <div class="form-group {{ $errors->first('mn_name') ? 'has-error' : ''}}">
					            <label for="name">Tên danh mục<span class="text-danger">(*)</span></label>
					            <input type="text" class="form-control" name="mn_name" placeholder="Name ...">	
					            @if ($errors->first('mn_name'))
					            	<span class="text-danger">{{ $errors->first('mn_name')}}</span>
					            @endif		        
    					<!-- /.box-body -->
                   		</div>
                		<div class="col-md-4"></div>
         				<div class="col-md-12">
         					<div class="box-footer text-center">
							    <a href="{{ route('admin.menu.index')}}"  class="class btn btn-danger">Quay lại <i class="fa fa-undo"></i></a>
							    <button type="submit" class="btn btn-success">Lưu dữ liệu <i class="fa fa-save"></i></button>
							</div>
         				</div>
					</form>
                </div>
            </div>
            <!-- /.box -->
    </section>
    <!-- /.content -->

@stop