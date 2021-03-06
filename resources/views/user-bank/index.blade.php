@extends('layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Tài khoản ngân hàng
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route( 'home' ) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'user-bank.index' ) }}">Tài khoản ngân hàng</a></li>
    <li class="active">List</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      @if(Session::has('message'))
      <p class="alert alert-info" >{{ Session::get('message') }}</p>
      @endif
      <a href="{{ route('user-bank.create') }}" class="btn btn-info" style="margin-bottom:5px">Add new</a>
      
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">List ( <span class="value">{{ $items->total() }} links )</span></h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">


           
   
             <div style="text-align:center">
              {{ $items->links() }}
            </div>  
            <table class="table table-bordered" id="table-list-data">
              <tr>
                <th style="width: 1%">#</th>                    
                <th>Tài khoản ngân hàng</th>                
                <th width="1%;white-space:nowrap">Action</th>
              </tr>
              <tbody>
              @if( $items->count() > 0 )
                <?php $i = 0; ?>
                @foreach( $items as $item )
                  <?php $i ++; ?>
                <tr id="row-{{ $item->id }}">
                  <td><span class="order">{{ $i }}</span></td>      
                  
                  <td>                  
                    {{ $item->bank_name }} chi nhánh {{ $item->branch }}<br>
                    {{ $item->fullname }} - {{ $item->account_no }}<br>                   
                    {{ $item->phone }}
                  </td>
                                   <td style="white-space:nowrap">                  
                    <a href="{{ route( 'user-bank.edit', [ 'id' => $item->id ]) }}" class="btn btn-warning btn-sm">Edit</a>                 
                    
                    <a onclick="return callDelete('{{ $item->title }}','{{ route( 'user-bank.destroy', [ 'id' => $item->id ]) }}');" class="btn btn-danger btn-sm">Delete</a>
                    
                  </td>
                </tr> 
                @endforeach
              @else
              <tr>
                <td colspan="3">Not found data.</td>
              </tr>
              @endif

            </tbody>
            </table>
            <div style="text-align:center">
              {{ $items->links() }}
            </div>  
           
        </div>        
      </div>
      <!-- /.box -->     
    </div>
    <!-- /.col -->  
  </div> 
</section>
<!-- /.content -->
</div>

@stop
@section('javascript_page')
<script type="text/javascript">
function callDelete(name, url){  
  swal({
    title: 'Bạn muốn xóa "' + name +'"?',
    text: "Dữ liệu sẽ không thể phục hồi.",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes'
  }).then(function() {
    location.href= url;
  })
  return flag;
}
</script>
@stop