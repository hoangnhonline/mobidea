@extends('layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Report : {{ date('d/m/Y') }}
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'home' ) }}">Report</a></li>
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
      <div class="box">  
        @if(Auth::user()->role == 3)
        <h3 style="padding-left:15px">Số dư hiện tại: <strong style="color : blue">{{ Auth::user()->total_money }}</strong></h3>             
        @endif
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered" id="table-list-data">
            @if(Auth::user()->role !=3 )
            <tr>
              @if(Auth::user()->role != 3)
              <th style="width: 1%">#</th>              
              <th>Member</th>
              @endif
              <th class="text-right">Traffic</th>              
              <th class="text-right">Tiền tạm tính</th>              
              <th width="1%"></th>
            </tr>
            <tbody>
            
            @if( $dataList->count() > 0 )
              <?php $i = 0; ?>
              @foreach( $dataList as $data )
                <?php $i ++; 
                $traffic = (int) $data->traffic;
                $traffic = ceil($traffic*env('TRAFFIC_PERCENT')/100);
                ?>
                <tr>
                  <td><span class="order">{{ $i }}</span></td>
                 
                  <td> 
                    {{ $data->fullname }}
                  </td>
                  <td class="text-right">{{ $traffic }}</td>                  
                  <td class="text-right">{{ $traffic*$cpa_traffic/1000 }}</td>                  
                  <td>
                    <a href="{{ route('account.update-end-date', ['id' => $data->user_id]) }}" class="btn btn-sm btn-info" >
                      Cập nhật
                    </a>
                  </td>
                </tr> 
              @endforeach
            @else
            <tr>
              <td colspan="9">Không có dữ liệu.</td>
            </tr>
            @endif
            @else
            <tr>
             
              <th class="text-center" style="font-size:30px">Traffic</th>              
              <th class="text-center" style="font-size:30px">Money</th>
            </tr>
            <tbody>
            <?php 
                $traffic =  (int) $dataList->traffic;
                $traffic = ceil($traffic*env('TRAFFIC_PERCENT')/100);
                ?>
            <tr>                
                <td class="text-center" style="font-size:30px">{{ $traffic }}</td>                  
                <td class="text-center" style="font-size:30px">{{ $traffic*$cpa_traffic/1000 }}</td>                  
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