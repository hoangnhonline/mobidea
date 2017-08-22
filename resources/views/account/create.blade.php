@extends('layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add member
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="{{ route('account.index') }}">Member</a></li>
      <li class="active">Add new</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <a class="btn btn-default btn-sm" href="{{ route('account.index') }}" style="margin-bottom:5px">Back</a>
    <form role="form" method="POST" action="{{ route('account.store') }}" id="formData">
    <div class="row">
      <!-- left column -->

      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Add member</h3>
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
                 <input type="hidden" name="role" value="3">
                 <!-- text input -->
                <div class="form-group">
                  <label>Full name <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="fullname" id="fullname" value="{{ old('fullname') }}">
                </div>
                <div class="form-group">
                  <label>Username <span class="red-star">*</span></label>
                  <input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}">
                </div>
                <div class="form-group">
                  <label>Smart link <span class="red-star">*</span></label>
                  <select class="form-control" name="smart_link_id" id="smart_link_id">
                    <option value="">--select--</option>
                    @foreach($smartLinkList as $link)
                    <option {{ old('smart_link_id') == $link->id ? "selected" : "" }} value="{{ $link->id }}">{{ $link->smart_link }}</option>
                    @endforeach
                  </select>
                </div>
                 <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                </div>                           
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status" id="status">                                      
                    <option value="1" {{ old('status') == 1 || old('status') == NULL ? "selected" : "" }}>Available</option>                  
                    <option value="2" {{ old('status') == 2 ? "selected" : "" }}>Lock</option>                    
                  </select>
                </div>
            </div>
            <div class="box-footer">
              <button type="button" class="btn btn-default" id="btnLoading" style="display:none"><i class="fa fa-spin fa-spinner"></i></button>
              <button type="submit" class="btn btn-primary" id="btnSave">Save</button>
              <a class="btn btn-default" class="btn btn-primary" href="{{ route('account.index')}}">Cancel</a>
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
        $('#btnSave').hide();
        $('#btnLoading').show();
      });
    });
    
</script>
@stop
