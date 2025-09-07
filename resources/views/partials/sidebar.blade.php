<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">My Admin</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('products.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Product Profiles</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('supplier.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Suppliers</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('order.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Order Management</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('customer.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Customer Management</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('grade.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Grade Management</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('category.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Category Management</span>
        </a>
    </li>

    <li class="nav-item active">
        <a class="nav-link" href="{{ route('inward.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Inwards</span>
        </a>
    </li>

</ul>
