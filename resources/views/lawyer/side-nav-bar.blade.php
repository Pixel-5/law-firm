<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('lawyer.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Lawyer </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('lawyer.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Shortcuts
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-folder"></i>
            <span>My Clients Cases</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List of Lawyers:</h6>
                <a class="collapse-item" href="#">Lawyer 1</a>
                <a class="collapse-item" href="#">Lawyer 2</a>
                <a class="collapse-item" href="#">Lawyer 3</a>
                <a class="collapse-item" href=#">Lawyer 4</a>
            </div>
        </div>
    </li>

    @can('event_access')
        <li class="nav-item">
            <a href="{{ route("lawyer.events.index") }}" class="nav-link {{ request()->is('lawyer/events') || request()->is('lawyer/events/*') ? 'active' : '' }}">
                <i class="fa-fw fas fa-calendar nav-icon">

                </i>
               Case Schedules
            </a>
        </li>
    @endcan
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-user-circle"></i>
            <span>My Clients</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List of Lawyers:</h6>
                <a class="collapse-item" href="#">Lawyer 1</a>
                <a class="collapse-item" href="#">Lawyer 2</a>
                <a class="collapse-item" href="#">Lawyer 3</a>
                <a class="collapse-item" href=#">Lawyer 4</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

</ul>
