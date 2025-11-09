<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">My Admin</div>
    </a>
    
    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Product Profiles -->
    <li class="nav-item {{ request()->routeIs('products.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('products.index') }}">
            <i class="fas fa-boxes"></i>
            <span>Product Profiles</span>
        </a>
    </li>

    <!-- Suppliers -->
    <li class="nav-item {{ request()->routeIs('supplier.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('supplier.index') }}">
            <i class="fas fa-truck"></i>
            <span>Suppliers</span>
        </a>
    </li>

    <!-- Orders -->
    <li class="nav-item {{ request()->routeIs('order.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('order.index') }}">
            <i class="fas fa-shopping-cart"></i>
            <span>Order Management</span>
        </a>
    </li>

    <!-- Customers -->
    <li class="nav-item {{ request()->routeIs('customer.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('customer.index') }}">
            <i class="fas fa-users"></i>
            <span>Customer Management</span>
        </a>
    </li>

    <!-- Metals -->
    <li class="nav-item {{ request()->routeIs('metal.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('metal.index') }}">
            <i class="fas fa-industry"></i>
            <span>Metal Management</span>
        </a>
    </li>

    <!-- Grades -->
    <li class="nav-item {{ request()->routeIs('grade.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('grade.index') }}">
            <i class="fas fa-layer-group"></i>
            <span>Grade Management</span>
        </a>
    </li>

    <!-- Categories -->
    <li class="nav-item {{ request()->routeIs('category.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('category.index') }}">
            <i class="fas fa-tags"></i>
            <span>Category Management</span>
        </a>
    </li>

    <!-- Inwards -->
    <li class="nav-item {{ request()->routeIs('inward.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('inward.index') }}">
            <i class="fas fa-arrow-down"></i>
            <span>Inwards</span>
        </a>
    </li>

    <!-- Supervisors -->
    <li class="nav-item {{ request()->routeIs('supervisor.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('supervisor.index') }}">
            <i class="fas fa-user-tie"></i>
            <span>Supervisors</span>
        </a>
    </li>

</ul>
