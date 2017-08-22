@extends('layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Cài đặt site
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('settings.index') }}">Cài đặt</a></li>
      <li class="active">Cập nhật</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">   
    <form role="form" method="POST" action="{{ route('settings.update') }}">
    <div class="row">
      <!-- left column -->

      <div class="col-md-7">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Cập nhật</h3>
          </div>
          <!-- /.box-header -->               
            {!! csrf_field() !!}

            <div class="box-body">
              @if (count($errors) > 0)
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              @if(Session::has('message'))
              <p class="alert alert-info" >{{ Session::get('message') }}</p>
              @endif
                 <!-- text input -->
                <div class="form-group">
                  <label>USD/K traffic</label>
                  <input type="text" class="form-control" name="cpa_traffic" id="cpa_traffic" value="{{ $settingArr['cpa_traffic'] }}">
                </div>
                
                <div class="form-group">
                  <label>Time Expires</label>
                  <input type="text" class="form-control" name="time_expires" id="time_expires" value="{{ $settingArr['time_expires'] }}">
                </div>
                <div class="form-group">
                  <label>Ignore IPs</label>
                  <textarea class="form-control" rows="4" name="ignore_ips" id="ignore_ips">{{ $settingArr['ignore_ips'] }}</textarea>
                </div>
            </div>                        
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Lưu</button>         
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
      <div class="col-md-5">
        <!-- general form elements -->
       
      <!--/.col (left) -->      
    </div>
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>

@stop