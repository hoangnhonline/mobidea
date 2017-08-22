@extends('layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tài khoản ngân hàng
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('user-bank.index') }}">Tài khoản ngân hàng</a></li>
      <li class="active">Add new</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('user-bank.index') }}" style="margin-bottom:5px">Back</a>
    <form role="form" method="POST" action="{{ route('user-bank.store') }}">
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
                  
                  <label>Tên ngân hàng<span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="bank_name" id="bank_name" value="{{ old('bank_name') }}">
                </div> 
                 <div class="form-group" >
                  
                  <label>Tên tài khoản<span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="fullname" id="fullname" value="{{ old('fullname') }}">
                </div>    
                 <div class="form-group" >
                  
                  <label>Số tài khoản<span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="account_no" id="account_no" value="{{ old('account_no') }}">
                </div>    
                 <div class="form-group" >
                  
                  <label>Chi nhánh<span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="branch" id="branch" value="{{ old('branch') }}">
                </div>   
                 <div class="form-group" >
                  
                  <label>Số điện thoại <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
                </div>   
                             
                  
            </div>              
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-sm">Save</button>
              <a class="btn btn-default btn-sm" href="{{ route('user-bank.index')}}">Cancel</a>
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