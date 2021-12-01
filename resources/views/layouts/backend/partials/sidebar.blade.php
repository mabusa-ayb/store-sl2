<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset ('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset ('assets/dist/img/user-bw.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block"><small>logged in as <span class="user_name"><strong>{{Auth::user()->name}}</strong></span></small></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link {{ Request::is('home*') ? 'active': '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            <li class="nav-header">INVENTORY</li>
          <li class="nav-item has-treeview {{ Request::is('master*') ? 'menu-open': '' }}">
            <a href="#" class="nav-link {{ Request::is('master*') ? 'active': '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('vendor.index')}}" class="nav-link {{ Request::is('master/vendor*') ? 'active': '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vendors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('product.index')}}" class="nav-link {{ Request::is('master/product*') ? 'active': '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview {{ Request::is('transaction*') ? 'menu-open': '' }}">
            <a href="#" class="nav-link {{ Request::is('transaction*') ? 'active': '' }}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Transactions
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('purchase-order.index')}}" class="nav-link {{ Request::is('transaction/purchase-order*') ? 'active': '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchase Order</p>
                </a>
              </li>
              <li class="nav-item">
                 <a href="{{route('sales.index')}}" class="nav-link {{ Request::is('transaction/sales*') ? 'active': '' }}">
                    <i class="far fa-circle nav-icon"></i>
                        <p>Sales Order</p>
                 </a>
              </li>
              <li class="nav-item">
                 <a href="{{route('transaction/stock')}}" class="nav-link {{ Request::is('transaction/stock*') ? 'active': '' }}">
                     <i class="far fa-circle nav-icon"></i>
                        <p>Stock</p>
                 </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview {{ Request::is('admin*') ? 'menu-open': '' }}">
               <a href="#" class="nav-link {{ Request::is('admin*') ? 'active': '' }}">
                   <i class="nav-icon fas fa-users-cog"></i>
                   <p>
                       Administration
                       <i class="fas fa-angle-left right"></i>
                   </p>
               </a>
               <ul class="nav nav-treeview">
                   <li class="nav-item">
                       <a href="{{route('users.index')}}" class="nav-link {{ Request::is('admin/users*') ? 'active': '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Users</p>
                       </a>
                   </li>
               </ul>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                      <a href="{{route('business.index')}}" class="nav-link {{ Request::is('admin/business*') ? 'active': '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Business Profile</p>
                      </a>
                  </li>
              </ul>
          </li>

          <li class="nav-item has-treeview {{ Request::is('reports/stocks*') ? 'menu-open': '' }}">
              <a href="#" class="nav-link {{ Request::is('reports/stocks*') ? 'active': '' }}">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                      Reports
                      <i class="fas fa-angle-left right"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                     <a href="{{ route('reports/stocks/report') }}" class="nav-link {{ Request::is('reports/stocks*') ? 'active': '' }}">
                          <i class="far fa-circle nav-icon"></i>
                          <p>Stock Reports</p>
                     </a>
                  </li>
              </ul>
          </li>

            <li class="nav-item has-treeview {{ Request::is('onlinestore*') ? 'menu-open': '' }}">
                <a href="#" class="nav-link {{ Request::is('onlinestore*') ? 'active': '' }}">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Online Store
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{url('onlinestore/product/category')}}" class="nav-link {{ Request::is('onlinestore/product/category*') ? 'active': '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Categories</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('onlineproduct.index')}}" class="nav-link {{ Request::is('onlinestore/product/onlineproduct*') ? 'active': '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Products</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('onlinesales.index')}}" class="nav-link {{ Request::is('onlinestore/onlinetransactions*') ? 'active': '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Sales</p>
                        </a>
                    </li>

                </ul>
            </li>

          <li class="nav-header">PROFILE</li>
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
              <i class="nav-icon fas fa-door-open text-danger"></i>
              <p class="text">Logout</p>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
              </form>

            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
