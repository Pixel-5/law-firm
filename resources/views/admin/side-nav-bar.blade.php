
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
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
            <span>List clients files</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Select File:</h6>
                @inject('files', 'App\Repository\FileRepositoryInterface')
                @foreach($files->allFiles() as $file)
                    <a class="collapse-item" href="{{ route('cases.show', $file->id) }}">{{ $file->number }}</a>
                @endforeach
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCases" aria-expanded="true" aria-controls="collapseCases">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Case schedules</span>
        </a>
        <div id="collapseCases" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List of Cases:</h6>
                @inject('cases', 'App\Repository\CaseRepositoryInterface')
                @foreach($cases->scheduledCases() as $case)
                    <a class="collapse-item" href="#">{{ $case->number }}</a>
                @endforeach
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-user-circle"></i>
            <span>Lawyers</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List of Lawyers:</h6>
                @inject('users', 'App\Repository\UserRepositoryInterface')
                @foreach($users->getLawyersOnly() as $lawyer)
                <a class="collapse-item" href="#">{{ $lawyer->name }}</a>
                    @endforeach
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    @can('user_management_access')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#userManagement"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-user-circle"></i>
                <span>{{ trans('cruds.userManagement.title') }}</span>
            </a>
            <div id="userManagement" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @can('permission_access')
                        <a href="{{ route("admin.permissions.index") }}"
                           class="collapse-item {{ request()->is('admin/permissions') ||
                              request()->is('admin/permissions/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-unlock-alt nav-icon">
                            </i>
                            {{ trans('cruds.permission.title') }}
                        </a>
                    @endcan
                    @can('role_access')
                        <a href="{{ route("admin.roles.index") }}" class="collapse-item
                        {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-briefcase nav-icon">
                            </i>
                            {{ trans('cruds.role.title') }}
                        </a>
                    @endcan
                        @can('user_access')
                            <a href="{{ route("admin.users.index") }}"
                               class="collapse-item {{ request()->is('admin/users') || request()->is('admin/users/*') ?
                                'active' : '' }}">
                                <i class="fa-fw fas fa-user nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                            @endcan
                </div>
            </div>
        </li>
    @endcan

</ul>
<!-- End of Sidebar -->
