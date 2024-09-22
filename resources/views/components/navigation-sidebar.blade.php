<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Mi sistema</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Inicio</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!--<div class="sidebar-heading">
        Interface
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="buttons.html">Buttons</a>
                <a class="collapse-item" href="cards.html">Cards</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">-->

    <!-- Heading -->
    <div class="sidebar-heading">
        Módulos
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <!--<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>-->

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('categories.index') }}">
            <i class="fas fa-fw fa-tags"></i>
            <span>Categorías</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('brands.index') }}">
            <i class="fas fa-copyright"></i>
            <span>Marcas</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('presentations.index') }}">
            <i class="fas fa-file-powerpoint"></i>
            <span>Presentaciones</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('products.index') }}">
            <i class="fas fa-box"></i>
            <span>Productos</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('suppliers.index') }}">
            <i class="fas fa-user-tie"></i>
            <span>Proveedores</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('clients.index') }}">
            <i class="fas fa-users"></i>
            <span>Clientes</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseShops"
            aria-expanded="true" aria-controls="collapseShops">
            <i class="fas fa-shopping-cart"></i>
            <span>Compras</span>
        </a>
        <div id="collapseShops" class="collapse" aria-labelledby="headingShops" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opciones:</h6>
                <a class="collapse-item" href="{{route('shops.index')}}">Ver todas</a>
                <a class="collapse-item" href="{{route('shops.create')}}">Crear una compra</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSales"
            aria-expanded="true" aria-controls="collapseSales">
            <i class="fas fa-shopping-basket"></i>
            <span>Ventas</span>
        </a>
        <div id="collapseSales" class="collapse" aria-labelledby="headingSales" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opciones:</h6>
                <a class="collapse-item" href="{{route('sales.index')}}">Ver todas</a>
                <a class="collapse-item" href="{{route('sales.create')}}">Crear una venta</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Tables -->
    <!--<li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>-->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <!--<div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
        <h6 class="text-center mb-2">Bienvenido <strong>DOUGLAS</strong></h6>
    </div>-->

</ul>
<!-- End of Sidebar -->
