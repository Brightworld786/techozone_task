 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <!-- Messages Dropdown Menu -->
 
      <li class="nav-item">
        <form action="{{ route('logout')}}" method="POST">
        @csrf
        <button class="btn btn-info" type="submit"> Logout</button>
      </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->