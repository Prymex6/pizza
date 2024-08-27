<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-black navbar-dark">

  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="index3.html" class="nav-link">{{ __('Dania') }}</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="index3.html" class="nav-link">{{ __('Kategorie') }}</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">{{ __('Zamówienia') }}</a>
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ Auth::user()->name }}
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <x-responsive-nav-link class="dropdown-item" :href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">
            {{ __('Log Out') }}
          </x-responsive-nav-link>
        </form>
      </div>
    </li>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('home.index') }}" class="brand-link">
    <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8"> -->
    <span class="brand-text font-weight-light">Italiano Pizza</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{ route('dish.index') }}" class="nav-link{{ Route::is('dish.index') ? ' active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              {{ __('Dania') }}
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('category.index') }}" class="nav-link{{ Route::is('category.index') ? ' active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              {{ __('Kategorie') }}
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link{{ Route::is('order.index') ? ' active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              {{ __('Zamówienia') }}
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('reservation.index') }}" class="nav-link{{ Route::is('reservation.index') ? ' active' : '' }}">
            <i class="nav-icon fa-solid fa-table"></i>
            <p>
              {{ __('Rezerwacje') }}
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('setting.index') }}" class="nav-link{{ Route::is('setting.index') ? ' active' : '' }}">
            <i class="nav-icon fa-solid fa-gear"></i>
            <p>
              {{ __('Ustawienia') }}
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>