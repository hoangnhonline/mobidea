@extends('layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Cập nhật tiền member : {{ $detail->fullname }}
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('account.update-end-date') }}">Cập nhật tiền</a></li>
      <li class="active">Add new</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('home') }}" style="margin-bottom:5px">Back</a>
    <form role="form" method="POST" action="{{ route('account.store-end-day') }}">
    <input type="hidden" name="user_id" value="{{ $detail->id }}">
    
    <div class="row">
      <!-- left column -->

      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Add new</h3>
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
                <div class="form-group" >
                  
                  <label>Ngày<span class="red-star">*</span></label>
                  <input type="text" class="form-control datepicker" name="date_get" id="date_get" value="{{ old('date_get', date('m/d/Y')) }}">
                </div>  
                <div class="form-group" >
                  
                  <label>Số tiền<span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="money" id="money" value="{{ old('money') }}">
                </div>          
                  
            </div>              
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-sm">Save</button>
              <a class="btn btn-default btn-sm" href="{{ route('smart-link.index')}}">Cancel</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>
    
      <!--/.col (left) -->      
    </div>
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
@stop