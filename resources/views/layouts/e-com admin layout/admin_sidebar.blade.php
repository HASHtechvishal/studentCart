  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('e-com images/admin images/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Hashtech | e-com</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar text-capitalize">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('e-com images/admin images/admin_pic/'.Auth::guard('admin')->user()->image)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::guard('admin')->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
 @if(Session::get('page')=="dashboard")
 <?php $active = "active"; ?>
 @else
 <?php $active = ""; ?>
 @endif 
            <li class="nav-item">                
            <a href="{{url('admin/dashboard')}}" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                dashboard
              </p>
            </a>
          </li> 
@if(Session::get('page')=="reset admin password" || Session::get('page')=="update admin data")
 <?php $active = "active"; ?>
 @else
 <?php $active = ""; ?>
 @endif                      
          <li class="nav-item has-treeview menu-open">
            <a href="" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                admin settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

@if(Session::get('page')=="reset admin password")
 <?php $active = "active"; ?>
 @else
 <?php $active = ""; ?>
 @endif              
              <li class="nav-item">
                <a href="/admin/setting" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>reset admin password</p>
                </a>
              </li>

 @if(Session::get('page')=="update admin data")
 <?php $active = "active"; ?>
 @else
 <?php $active = ""; ?>
 @endif                           
              <li class="nav-item">
                <a href="/admin/update_admin_data" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>update admin data</p>
                </a>
              </li>
            </ul>
          </li>
@if(Session::get('page')=="categories" || Session::get('page')=="sections" || Session::get('page')=="products" || Session::get('page')=="brands" || Session::get('page')=="banners" || Session::get('page')=="coupon");
 <?php $active = "active"; ?>
 @else
 <?php $active = ""; ?>
 @endif                      
          <li class="nav-item has-treeview menu-open">
            <a href="" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                catalogues
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

@if(Session::get('page')=="sections")
 <?php $active = "active"; ?>
 @else
 <?php $active = ""; ?>
 @endif              
              <li class="nav-item">
                <a href="/admin/section" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>sections</p>
                </a>
              </li>

 @if(Session::get('page')=="brands")
 <?php $active = "active"; ?>
 @else
 <?php $active = ""; ?>
 @endif                           
              <li class="nav-item">
                <a href="/admin/brand" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>brands</p>
                </a>
              </li>

 @if(Session::get('page')=="categories")
 <?php $active = "active"; ?>
 @else
 <?php $active = ""; ?>
 @endif                           
              <li class="nav-item">
                <a href="/admin/categories" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>categories</p>
                </a>
              </li>
@if(Session::get('page')=="products")
 <?php $active = "active"; ?>
 @else
 <?php $active = ""; ?>
 @endif                           
              <li class="nav-item">
                <a href="/admin/products" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>products</p>
                </a>
              </li>
 @if(Session::get('page')=="banners")
 <?php $active = "active"; ?>
 @else
 <?php $active = ""; ?>
 @endif                           
              <li class="nav-item">
                <a href="/admin/banner" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>banners</p> 
                </a>
              </li>

@if(Session::get('page')=="coupon")
 <?php $active = "active"; ?>
 @else
 <?php $active = ""; ?>
 @endif                           
              <li class="nav-item">
                <a href="/admin/coupons" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>coupons</p> 
                </a>
              </li>

@if(Session::get('page')=="orders")
 <?php $active = "active"; ?>
 @else
 <?php $active = ""; ?>
 @endif                           
              <li class="nav-item">
                <a href="/admin/orders" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Orders</p>  
                </a>
              </li>

            </ul>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>































