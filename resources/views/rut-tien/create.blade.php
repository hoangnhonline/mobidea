@extends('layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Yêu cầu rút tiền
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('rut-tien.index') }}">Rút tiền</a></li>
      <li class="active">Add new</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('rut-tien.index') }}" style="margin-bottom:5px">Back</a>
    <form role="form" method="POST" action="{{ route('rut-tien.store') }}" id="formData">
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
            @if(Auth::user()->role == 3)
        <h3 style="padding-left:10px">Số dư hiện tại: <strong style="color : blue">{{ Auth::user()->total_money }}</strong></h3>    
        <input type="hidden" id="total_money" value="{{ Auth::user()->total_money }}">         
        @endif
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
                
                <label>Số tiền<span class="red-star">*</span></label>
                <input type="text" class="form-control" name="money_request" id="money_request" value="{{ old('money_request') }}">
              </div> 

              <div class="form-group" >
                
                <label>Tài khoản ngân hàng<span class="red-star">*</span></label>
                <select name="bank_id" id="bank_id" class="form-control">
                  <option value="">--select--</option>
                  @foreach($bankList as $bank)
                  <option value="{{ $bank->id }}" {{ old('bank_id') ? "selected" : "" }}>{{ $bank->bank_name }}-{{ $bank->account_no }}</option>
                  @endforeach
                </select>
              </div>
                  
            </div>              
            <div class="box-footer">
              <button type="submit" class="btn btn-primary btn-sm" id="btnSave">Save</button>
              <a class="btn btn-default btn-sm" href="{{ route('rut-tien.index')}}">Cancel</a>
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
@section('javascript_page')
<script type="text/javascript">
  $(document).ready(function(){
    $('#formData').submit(function(){
      var money_request = $('#money_request').val();
      var total_money = $('#total_money').val();
      if(money_request > total_money){
        alert('Số tiền được rút tối đa là ' + total_money  + '$');
        return false;
      }
    });
    $('#btnSave').click(function(){
      var money_request = $('#money_request').val();
      var total_money = $('#total_money').val();
      if(money_request > total_money){
        alert('Số tiền được rút tối đa là ' + total_money  + '$');
        return false;
      }
    });
  });
</script>
@stop