 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
         <div class="sidebar-brand-icon ">
             <img src="{{ asset('startbootstrap/img/mcx.png') }}" alt="" width="140">
         </div>
         <div class="sidebar-brand-text mx-3">SPRS</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
         <a class="nav-link" href="{{ url('/') }}">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Painel</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Utilizador
     </div>



     <!-- Nav Item - utilizadores -->
     <li class="nav-item">
         <a class="nav-link" href="{{ route('admin.user.index') }}">
             <i class="fa fa-user" aria-hidden="true"></i>
             @if (Auth::user()->level == 'Administrador')
                 <span>Utilizadores</span>
         </a>
     @else
         <span>Perfil</span></a>
         @endif
     </li>

     <!-- Nav Item - Tables -->




     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         API
     </div>

     <!-- Nav Item - entidades -->
     <li class="nav-item">
        <a class="nav-link" href="{{route('admin.entity.index')}}">
            <i class="fa fa-building" aria-hidden="true"></i>
            <span>Entidade</span></a>
    </li>


    <!-- Nav Item - reference -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.reference.index')}}">
            <i class="fas fa-receipt" aria-hidden="true"></i>
            <span>Referências</span></a>
    </li>

     <!-- Nav Item - payments  -->
     <li class="nav-item">
        <a class="nav-link" href="{{route('admin.payment.index')}}">
            <i class="fas fa-hourglass-start" aria-hidden="true"></i>
            <span>Pagamentos em Fila</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.payment.index2')}}">
            <i class="fas fa-check-circle" aria-hidden="true"></i>
            <span>Pagamentos Confirmados</span></a>
    </li>

     @if (Auth::user()->level == 'Administrador')
         <!-- Divider -->
         <hr class="sidebar-divider">

         <!-- Heading -->
         <div class="sidebar-heading">
             Relatórios
         </div>

        

         <li class="nav-item">
             <a class="nav-link" href="{{ route('admin.log.search') }}">
                 <i class="fa fa-file"></i>
                 <span>Registro de Actividades</span></a>
         </li>



         <li class="nav-item">
             <a class="nav-link" href="{{ route('admin.log.search.print') }}">
                 <i class="fa fa-print"></i>
                 <span>Imprimir Registros</span></a>
         </li>
     @endif




     <!-- Divider -->
     <hr class="sidebar-divider d-none d-md-block">

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

     <!-- Sidebar Message -->


 </ul>
 <!-- End of Sidebar -->
