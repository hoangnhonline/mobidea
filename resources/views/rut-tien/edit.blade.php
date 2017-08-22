@extends('layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Rút tiền   
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('rut-tien.index') }}">Rút tiền</a></li>
      <li class="active">Update</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('rut-tien.index') }}" style="margin-bottom:5px">Quay lại</a>
    <form role="form" method="POST" action="{{ route('rut-tien.update') }}">
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
                @if(Auth::user()->role != 3)                         
                <div class="form-group" >
                
                  <label>Trạng thái<span class="red-star">*</span></label>
                  <select name="status" id="status" class="form-control">
                    <option value="1" {{ $detail->status == 1 ? "selected"  : "" }}>Đang yêu cầu</option>
                    <option value="2" {{ $detail->status == 2 ? "selected"  : "" }}>Đã chuyển tiền</option>
                  </select>
                </div>
                <input type="hidden" name="xac_nhan" value="1">  
               
                <div class="form-group" >
                  
                  <label>Rút tiền<span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="money_request" id="money_request" value="{{ old('money_request', $detail->money_request) }}" disabled="disabled">
                </div>                
                 <div class="form-group" >
                
                  <label>Tài khoản ngân hàng<span class="red-star">*</span></label>
                  <select name="bank_id" id="bank_id" class="form-control" disabled="disabled">
                    <option value="">--select--</option>
                    @foreach($bankList as $bank)
                    <option value="{{ $bank->id }}" {{ old('bank_id', $detail->bank_id) ? "selected" : "" }}>{{ $bank->bank_name }}-{{ $bank->account_no }}</option>
                    @endforeach
                  </select>
                </div>  
                 @else
                 <div class="form-group" >
                  
                  <label>Rút tiền<span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="money_request" id="money_request" value="{{ old('money_request', $detail->money_request) }}">
                </div>                
                 <div class="form-group" >
                
                  <label>Tài khoản ngân hàng<span class="red-star">*</span></label>
                  <select name="bank_id" id="bank_id" class="form-control">
                    <option value="">--select--</option>
                    @foreach($bankList as $bank)
                    <option value="{{ $bank->id }}" {{ old('bank_id', $detail->bank_id) ? "selected" : "" }}>{{ $bank->bank_name }}-{{ $bank->account_no }}</option>
                    @endforeach
                  </select>
                </div>
                <input type="hidden" name="xac_nhan" value="0"> 
                 @endif
                 
            </div>                      
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-sm">Save</button>
              <a class="btn btn-default btn-sm" href="{{ route('rut-tien.index')}}">Cancel</a>
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