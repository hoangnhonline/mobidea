@extends('layout')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Rút tiền
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route( 'home' ) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="{{ route( 'rut-tien.index' ) }}">Rút tiền</a></li>
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
      @if(Auth::user()->role == 3)
      <a href="{{ route('rut-tien.create') }}" class="btn btn-info btn-sm" style="margin-bottom:5px">Yêu cầu rút tiền</a>
      @endif
      
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">History ( <span class="value">{{ $items->total() }} )</span></h3>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">   
             <div style="text-align:center">
              {{ $items->links() }}
            </div>  
            <table class="table table-bordered" id="table-list-data">
              <tr>
                <th style="width: 1%">#</th>      
                @if(Auth::user()->role !=3)
                <th>Member</th>            
                @endif  
                <th>Ngày yêu cầu</th>

                <th class="text-right">Số tiền</th>
                <th class="text-center">Trạng thái</th>
                <th width="1%;white-space:nowrap">Action</th>
              </tr>
              <tbody>
              @if( $items->count() > 0 )
                <?php $i = 0; ?>
                @foreach( $items as $item )
                  <?php $i ++; ?>
                <tr id="row-{{ $item->id }}">
                  <td><span class="order">{{ $i }}</span></td>
                  @if(Auth::user()->role !=3)   
                  <td>{{ $item->fullname }}</td>   
                  @endif
                  <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                  <td class="text-right">                  
                    {{ $item->money_request }}
                  </td>
                  <td class="text-center">
                    @if($item->status == 1)
                      <label class="label label-danger">Đang yêu cầu</label>
                    @else
                       <label class="label label-success">Đã chuyển</label>
                    @endif
                  </td>
                  <td style="white-space:nowrap">                  
                    @if($item->status == 1)
                    <a href="{{ route( 'rut-tien.edit', [ 'id' => $item->id ]) }}" class="btn btn-warning btn-sm" title="Edit">
                      <i class="fa fa-edit"></i>
                    </a>                 
                    
                    <a onclick="return callDelete('{{ $item->title }}','{{ route( 'rut-tien.destroy', [ 'id' => $item->id ]) }}');" class="btn btn-danger btn-sm" title="Delete">
                      <i class="fa fa-trash"></i>
                    </a>
                    @endif
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
    title: 'Bạn có chắc chắn xóa ?',
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