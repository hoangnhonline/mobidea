@extends('layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tài khoản ngân hàng   
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('user-bank.index') }}">Tài khoản ngân hàng</a></li>
      <li class="active">Update</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('user-bank.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('user-bank.update') }}">
    <div class="row">
      <!-- left column -->
      <input name="id" value="{{ $detail->id }}" type="hidden">
      <div class="col-md-7">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Update</h3>
          </div>
          <!-- /.box-header -->               
            {!! csrf_field() !!}

            <div class="box-body">
              @if(Session::has('message'))
              <p class="alert alert-info" >{{ Session::get('message') }}</p>
              @endif
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
                  
                  <label>Tên ngân hàng<span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="bank_name" id="bank_name" value="{{ old('bank_name', $detail->bank_name) }}">
                </div> 
                 <div class="form-group" >
                  
                  <label>Tên tài khoản<span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="fullname" id="fullname" value="{{ old('fullname', $detail->fullname) }}">
                </div>    
                 <div class="form-group" >
                  
                  <label>Số tài khoản<span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="account_no" id="account_no" value="{{ old('account_no', $detail->account_no) }}">
                </div>    
                 <div class="form-group" >
                  
                  <label>Chi nhánh<span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="branch" id="branch" value="{{ old('branch', $detail->branch) }}">
                </div>   
                 <div class="form-group" >
                  
                  <label>Số điện thoại <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', $detail->phone) }}">
                </div>            
                  
            </div>                      
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-sm">Save</button>
              <a class="btn btn-default btn-sm" href="{{ route('user-bank.index')}}">Cancel</a>
            </div>
            
        </div>
        <!-- /.box -->     

      </div>         
    </div>
    </form>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
@stop