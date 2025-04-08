 <!-- Sidebar -->
 <div class="sidebar" data-background-color="dark">
     <div class="sidebar-logo">
         <!-- Logo Header -->
         <div class="logo-header" data-background-color="dark">
             <a href="index.php" class="logo">
                 <img src="{{ URL::asset('assets/img/kaiadmin/logo_light.svg') }} " alt="navbar brand" class="navbar-brand"
                     height="30" />
             </a>
             <div class="nav-toggle">
                 <button class="btn btn-toggle toggle-sidebar">
                     <i class="gg-menu-right"></i>
                 </button>
                 <button class="btn btn-toggle sidenav-toggler">
                     <i class="gg-menu-left"></i>
                 </button>
             </div>
             <button class="topbar-toggler more">
                 <i class="gg-more-vertical-alt"></i>
             </button>
         </div>
         <!-- End Logo Header -->
     </div>
     <div class="sidebar-wrapper scrollbar scrollbar-inner">
         <div class="sidebar-content">
             <ul class="nav nav-secondary">
                 <li class="nav-item {{ url()->current() === route('dashboard') ? 'active' : '' }}">
                     <a href="{{ route('dashboard') }}" class="collapsed" aria-expanded="false">
                         <i class="fas fa-home"></i>
                         <p>Dashboard</p>
                     </a>
                 </li>
                 <li class="nav-item {{ url()->current() === route('warga.index') ? 'active' : '' }}">
                     <a href="{{ route('warga.index') }}">
                         <i class="fas fa-layer-group"></i>
                         <p>Data Warga</p>
                     </a>

                 </li>
                 <li class="nav-item {{ url()->current() === route('kriteria.index') ? 'active' : '' }}">
                     <a href="{{ route('kriteria.index') }}">
                         <i class="fas fa-th-list"></i>
                         <p>Data Kriteria</p>
                     </a>
                 </li>
                 <li class="nav-item {{ url()->current() === route('subkriteria.index') ? 'active' : '' }}">
                     <a href="{{ route('subkriteria.index') }}">
                         <i class="fas fa-th-list"></i>
                         <p>Data Sub Kriteria</p>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a href="javascript:void(0);" data-toggle="collapse" data-target="#tables" aria-expanded="false"
                         aria-controls="tables">
                         <i class="fas fa-table"></i>
                         <p>Perhitungan</p>
                         <span class="caret"></span>
                     </a>
                     <div class="collapse {{ url()->current() === route('perhitungan-ahp') || url()->current() === route('hasil-perhitungan') ? 'show' : '' }}"
                         id="tables">
                         <ul class="nav nav-collapse">
                             <li class="nav-item {{ url()->current() === route('perhitungan-ahp') ? 'active' : '' }}">
                                 <a href="{{ route('perhitungan-ahp') }}">
                                     <span class="sub-item">Perhitungan AHP</span>
                                 </a>
                             </li>
                             <li
                                 class="nav-item {{ url()->current() === route('hasil-perhitungan') ? 'active' : '' }}">
                                 <a href="{{ route('hasil-perhitungan') }}">
                                     <span class="sub-item">Hasil Perhitungan AHP</span>
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </li>

                 <li class="nav-item {{ url()->current() === route('kriteria-warga.index') ? 'active' : '' }}">
                     <a href="{{ route('kriteria-warga.index') }}">
                         <i class="fas fa-th-list"></i>
                         <p>Data Kriteria Warga</p>
                     </a>
                 </li>
                 <li class="nav-item {{ url()->current() === route('perangkingan') ? 'active' : '' }}">
                     <a href="{{ route('perangkingan') }}">
                         <i class="far fa-chart-bar"></i>
                         <p>Perangkingan</p>
                     </a>
                 </li>
                 <li class="nav-item {{ url()->current() === route('operator.index') ? 'active' : '' }}">
                     <a href="{{ route('operator.index') }}">
                         <i class="fas fa-user"></i>
                         <p>Operator</p>
                     </a>
                 </li>
             </ul>
         </div>
     </div>
 </div>
 <!-- End Sidebar -->
