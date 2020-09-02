
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
            <i class="fas fa-fw fa-folder-open"></i>
            <span>Litigation</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List of Litigation:</h6>
                @foreach ($myLitigation as $case)
                    <a class="collapse-item" href="{{ route('lawyer.litigation.show', $case->id) }}">{{ $case->number }} </a>
                @endforeach
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>Conveyancing</span>
        </a>
        <div id="collapse3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List of Conveyancing:</h6>
                @foreach ($myConveyancing as $conveyance)
                    <a class="collapse-item" href="{{ route('lawyer.conveyancing.show', $conveyance->id) }}">{{ $conveyance->number }} </a>
                @endforeach
            </div>
        </div>
    </li>


{{--    <li class="nav-item">--}}
{{--        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePending"--}}
{{--           aria-expanded="true" aria-controls="collapseClients">--}}
{{--            <i class="fa fa-folder-open"></i>--}}
{{--            <span>Pending Request</span>--}}
{{--        </a>--}}
{{--        <div id="collapsePending" class="collapse" aria-labelledby="collapseClients" data-parent="#accordionSidebar">--}}
{{--            <div class="bg-white py-2 collapse-inner rounded">--}}
{{--                <h6 class="collapse-header">--}}
{{--                    List of Pending Request:--}}
{{--                    <span class="badge badge-secondary">{{ $myClients->count() }}</span>--}}
{{--                </h6>--}}
{{--                @foreach ($myClients as $client)--}}
{{--                    <a class="collapse-item" href="#">{{ $client->clientable->name }} {{ $client->clientable->surname }}--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </li>--}}
    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClients"
           aria-expanded="true" aria-controls="collapseClients">
            <i class="fas fa-fw fa-user-circle"></i>
            <span>My Clients</span>
        </a>
        <div id="collapseClients" class="collapse" aria-labelledby="collapseClients" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">List of Clients:
                    <span class="badge badge-secondary">{{ $myClients->count() }}</span>
                </h6>
                @foreach ($myClients as $client)
                    <a class="collapse-item" href="#">{{ $client->clientable->name }} {{ $client->clientable->surname }}
                    </a>
                @endforeach
            </div>
        </div>
    </li>
</ul>
