<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-box"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>


    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Management
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Internal</h6>
                <a class="collapse-item" href="{{ route('staffs.index') }}">Staffs</a>
                <h6 class="collapse-header">External</h6>
                <a class="collapse-item" href="{{ route('customers.index') }}">Customers</a>
                <a class="collapse-item" href="#">Supplier</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Entities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Entities</h6>
                <a class="collapse-item" href="{{ route('boards.index') }}">Boards</a>
                <a class="collapse-item" href="{{ route('products.index') }}">Products</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Monitoring
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('orders.index') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Orders</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-list"></i>
            <span>Purchase</span></a>
    </li>
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-truck"></i>
            <span>Deliveries</span></a>
    </li>
    <hr class="sidebar-divider">
</ul>
