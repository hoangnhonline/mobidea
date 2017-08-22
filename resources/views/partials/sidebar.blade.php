<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ URL::asset('public/admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->fullname }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="{{ in_array(\Request::route()->getName(), ['home']) ? 'active' : '' }}">
        <a href="{{ route('home') }}">
          <i class="fa fa-twitch"></i> 
          <span>Reports</span>          
        </a>       
      </li>
      <li class="{{ in_array(\Request::route()->getName(), ['rut-tien.index', 'rut-tien.create', 'rut-tien.edit']) ? 'active' : '' }}">
        <a href="{{ route('rut-tien.index') }}">
          <i class="fa fa-twitch"></i> 
          @if(Auth::user()->role == 3)
          <span>Rút tiền</span>
          @else          
          <span>Yêu cầu rút tiền ({{ DB::table('withdraw_history')->where('status', 1)->get()->count() }})</span>
          @endif
          
        </a>       
      </li>
       <li class="{{ in_array(\Request::route()->getName(), ['user-bank.index', 'user-bank.create', 'user-bank.edit']) ? 'active' : '' }}">
        <a href="{{ route('user-bank.index') }}">
          <i class="fa fa-twitch"></i> 
          <span>Tài khoản ngân hàng</span>
          
        </a>       
      </li>
      @if(Auth::user()->role != 3)
      <li class="treeview {{ in_array(\Request::route()->getName(), ['settings.index', 'account.index', 'account.create', 'account.edit','smart-link.index', 'smart-link.create', 'smart-link.edit']) ? 'active' : '' }}">
        <a href="#">
          <i class="fa  fa-gears"></i>
          <span>Settings</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li {{ \Request::route()->getName() == "settings.index" ? "class=active" : "" }}><a href="{{ route('settings.index') }}"><i class="fa fa-circle-o"></i> Các thông số</a></li>
          @if(Auth::user()->role == 1)
          <li {{ in_array(\Request::route()->getName(), ['smart-link.index', 'smart-link.create', 'smart-link.edit']) ? 'class=active' : '' }}><a href="{{ route('smart-link.index') }}"><i class="fa fa-circle-o"></i> Smart link</a></li>            
          <li {{ \Request::route()->getName() == "account.index" ? "class=active" : "" }}><a href="{{ route('account.index') }}"><i class="fa fa-circle-o"></i> Member</a></li>         
          @endif
        </ul>
      </li>
      @endif
    
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<style type="text/css">
  .skin-blue .sidebar-menu>li>.treeview-menu{
    padding-left: 15px !important;
  }
</style>