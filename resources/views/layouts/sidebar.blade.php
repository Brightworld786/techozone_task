 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{asset('index3.html')}}" class="brand-link">
      <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Techozone</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-is-opening menu-open {{ request()->is('dashboard*') ? 'active' : '' }} ">
            <a href="{{route('dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
          </li> 
          <li class="nav-item menu-is-opening menu-open  {{ request()->is('company*') ? 'active' : '' }} ">
            <a href="{{route('company.index')}}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Company
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
          </li>
          <li class="nav-item menu-is-opening menu-open  {{ request()->is('employee*') ? 'active' : '' }} ">
            <a href="{{route('employee.index')}}" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Employee
                {{-- <i class="right fas fa-angle-left"></i> --}}
              </p>
            </a>
          </li>

          {{-- <li class="nav-item menu-is-opening menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Company
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: block;">
              <li class="nav-item {{ request()->is('company*') ? 'active' : '' }} ">
                <a href="{{route('company.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>create</p>
                </a>
              </li>
            </ul>
          </li> --}}
          {{-- <li class="nav-item {{ request()->is('occupation*') ? 'active' : '' }} ">
            <a class="nav-link" href="{{ route('occupation.create') }}">
                <span class="sidebar-mini"> O </span>
                <span class="sidebar-normal"> Occupation </span>
            </a>
        </li> --}}
     
        </ul>
      </nav>

      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
    
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
