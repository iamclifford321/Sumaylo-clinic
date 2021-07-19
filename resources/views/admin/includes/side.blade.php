<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src=" {{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">HMS</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src=" {{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ $userLogged->firstName }} {{ $userLogged->lastName }}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="tree" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

        <?php
          // $currentURL = Request::url();
          //
          // dd($currentURL);
          ?>
         <li class="nav-item">
           <a href="{{ route('admin.dasboard') }}" class="nav-link @if(Route::current()->getName() == 'admin.dasboard') active @endif">
             <i class="nav-icon fas fa-tachometer-alt"></i>
             <p>
               Dashboard
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="{{ route('admin.reports') }}" class="nav-link @if(Route::current()->getName() == 'admin.reports') active @endif">
             <i class="nav-icon fas fa-chart-bar"></i>
             <p>
               Reports
             </p>
           </a>
         </li>

         <li class="nav-item">
           <a href="{{ route('admin.chat') }}" class="nav-link @if(Route::current()->getName() == 'admin.chat') active @endif">
             <i class="nav-icon fas fa-comment"></i>
             <p>
               Chat
             </p>
           </a>
         </li>

        <li class="nav-item @if(Route::current()->getName() == 'admin.services' || Route::current()->getName() == 'admin.addServices' || Route::current()->getName() == 'admin.addServices') menu-open @endif">
          <a href="{{ route('admin.services') }}" class="nav-link @if(Route::current()->getName() == 'admin.services' || Route::current()->getName() == 'admin.addServices') active @endif">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>
              Services
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.services') }}" class="nav-link @if(Route::current()->getName() == 'admin.services') active @endif">
                <i class="fas fa-tasks nav-icon"></i>
                <p>Manage services</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.addServices') }}" class="nav-link @if(Route::current()->getName() == 'admin.addServices') active @endif">
                <i class="fas fa-plus nav-icon"></i>
                <p>Add services</p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-item @if(Route::current()->getName() == 'admin.doctors' || Route::current()->getName() == 'admin.addDoctors' ) menu-open @endif">
          <a href="{{ route('admin.doctors') }}" class="nav-link @if(Route::current()->getName() == 'admin.doctors' || Route::current()->getName() == 'admin.addDoctors') active @endif">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>
              Doctors
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="{{ route('admin.doctors') }}" class="nav-link @if(Route::current()->getName() == 'admin.doctors') active @endif">
                <i class="fas fa-tasks nav-icon"></i>
                <p>Manage doctors</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('admin.addDoctors') }}" class="nav-link @if(Route::current()->getName() == 'admin.addDoctors') active @endif">
                <i class="fas fa-plus nav-icon"></i>
                <p>Add doctors</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.onlinePatients') }}" class="nav-link @if(Route::current()->getName() == 'admin.onlinePatients') active @endif">
            <i class="nav-icon fas fa-globe"></i>
            <p>
              Online patients
            </p>
          </a>
        </li>


        <li class="nav-item @if(Route::current()->getName() == 'admin.walkIn' || Route::current()->getName() == 'admin.addWalkIn' || Route::current()->getName() == 'admin.bookAppointmentWalkIn') menu-open @endif">
          <a href="{{ route('admin.walkIn') }}" class="nav-link @if(Route::current()->getName() == 'admin.walkIn' || Route::current()->getName() == 'admin.addWalkIn' || Route::current()->getName() == 'admin.bookAppointmentWalkIn') active @endif">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>
              Walk-in patients
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.walkIn') }}" class="nav-link @if(Route::current()->getName() == 'admin.walkIn') active @endif">
                <i class="fas fa-tasks nav-icon"></i>
                <p>Manage patients</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('admin.addWalkIn') }}" class="nav-link @if(Route::current()->getName() == 'admin.addWalkIn') active @endif">
                <i class="fas fa-plus nav-icon"></i>
                <p>Add patients</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('admin.bookAppointmentWalkIn') }}" class="nav-link @if(Route::current()->getName() == 'admin.bookAppointmentWalkIn') active @endif">
                <i class="fas fa-calendar-check nav-icon"></i>
                <p>Book appointment</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.appointmentToday') }}" class="nav-link @if(Route::current()->getName() == 'admin.appointmentToday') active @endif">
            <i class="nav-icon fas fa-calendar-day"></i>
            <p>
              Todays appointment
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.appointmentCalendar') }}" class="nav-link @if(Route::current()->getName() == 'admin.appointmentCalendar') active @endif">
            <i class="nav-icon fas fa-calendar-alt"></i>
            <p>
              Calendar of appointment
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.payment') }}" class="nav-link @if(Route::current()->getName() == 'admin.payment') active @endif">
            <i class="nav-icon fas fa-money-check-alt"></i>
            <p>
              Payment
            </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
