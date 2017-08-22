@extends('layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Member
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'account.index' ) }}">Member</a></li>
    <li class="active">Danh sách</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      @if(Session::has('message'))
      <p class="alert alert-info" >{{ Session::get('message') }}</p>
      @endif
      <a href="{{ route('account.create') }}" class="btn btn-info btn-sm" style="margin-bottom:5px">Add member</a>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Filter</h3>
        </div>        
      </div>
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">List</h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered" id="table-list-data">
            <tr>
              <th style="width: 1%">#</th>              
              <th>Full name</th>
              <th>Username</th>
              <th>Smart link</th>              
              <th>Status</th>
              <th width="1%" style="white-space:nowrap">Action</th>
            </tr>
            <tbody>
            @if( $items->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $items as $item )
                <?php $i ++; ?>
                <tr id="row-{{ $item->id }}">
                  <td><span class="order">{{ $i }}</span></td>
                 
                  <td>                  
                    <a href="{{ route( 'account.edit', [ 'id' => $item->id ]) }}">{{ $item->fullname }}</a>                                
                    <br>
                    {{ $item->email }}
                  </td>
                  <td><strong style="color:#dd4b39 ">{{ $item->username }}</strong></td>   
                  <td>
                    <a href="{{ $item->smartLink->smart_link }}" target="_blank">{{ $item->smartLink->smart_link }}</a>
                  </td>
                  <td>@if($item->status == 1) 
                    <label class="label label-info">Available</label>
                    @else<label class="label label-danger">Lock</label>
                    @endif</td>
                  <td style="white-space:nowrap">  
                    <a href="{{ route( 'account.update-status', ['status' => $item->status == 1 ? 2 : 1 , 'id' => $item->id ])}}" @if($item->status == 1) title="Khóa" @else title="Mở khóa" @endif class="btn btn-sm {{ $item->status == 1 ? "btn-warning" : "btn-info" }}" 
                    @if( $item->status == 2)
                    onclick="return confirm('Bạn chắc chắn muốn MỞ khóa tài khoản này? '); "
                    @else
                    onclick="return confirm('Bạn chắc chắn muốn KHÓA tài khoản này? '); "
                    @endif
                    >
                    @if($item->status == 1)
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    @else
                    <i class="fa fa-unlock" aria-hidden="true"></i>
                    @endif
                    </a>
                    <a href="{{ route( 'account.edit', [ 'id' => $item->id ]) }}" class="btn-sm btn btn-primary" title="Edit">
                      <i class="fa fa-edit" aria-hidden="true"></i>
                    </a>                 
                    
                    <a onclick="return callDelete('{{ $item->name }}','{{ route( 'account.destroy', [ 'id' => $item->id ]) }}');" class="btn-sm btn btn-danger" title="Delete">
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                    
                  </td>
                </tr> 
              @endforeach
            @else
            <tr>
              <td colspan="9">Not found data.</td>
            </tr>
            @endif

          </tbody>
          </table>
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
$(document).ready(function(){
  $('#table-list-data tbody').sortable({
        placeholder: 'placeholder',
        handle: ".move",
        start: function (event, ui) {
                ui.item.toggleClass("highlight");
        },
        stop: function (event, ui) {
                ui.item.toggleClass("highlight");
        },          
        axis: "y",
        update: function() {
            var rows = $('#table-list-data tbody tr');
            var strOrder = '';
            var strTemp = '';
            for (var i=0; i<rows.length; i++) {
                strTemp = rows[i].id;
                strOrder += strTemp.replace('row-','') + ";";
            }     
            updateOrder("loai_sp", strOrder);
        }
    });
});
function updateOrder(table, strOrder){
  $.ajax({
      url: $('#route_update_order').val(),
      type: "POST",
      async: false,
      data: {          
          str_order : strOrder,
          table : table
      },
      success: function(data){
          var countRow = $('#table-list-data tbody tr span.order').length;
          for(var i = 0 ; i < countRow ; i ++ ){
              $('span.order').eq(i).html(i+1);
          }                        
      }
  });
}
</script>
@stop