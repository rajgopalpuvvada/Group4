<!-- Sidebar -->
<ul style="padding-top: 1rem;" class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion sidebar-navbar-nav" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#"> 
        <div class="sidebar-brand-text mx-3"><?= $_ENV['APP_NAME'] ?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span route-path="dashboard-area">Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Ticket Management</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded"> 
                <a hidden="hidden" class="collapse-item create-tickets-nav" href="#" route-path="create-tickets" id="create-tickets">Create Tickets</a>
                <a hidden="hidden" class="collapse-item ticket-layout-nav" href="#" route-path="ticket-layout-area" id="ticket-layout-area">Create Tickets</a>
                <a class="collapse-item" href="#" route-path="manage-all-tickets" id="manage-all-tickets">Manage Tickets</a> 
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Clients Management</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded"> 
                <a class="collapse-item" href="#" route-path="create-clients" id="create-clients">Register Client <br> <small>Register clients in the system</small></a>
                <a class="collapse-item manage-clients-route" href="#" route-path="manage-all-clients" id="manage-all-clients">Manage Clients</a> 
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Events Management</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded"> 
                <a class="collapse-item" href="#" route-path="create-events" id="create-events">Create Event</a>
                <a class="collapse-item" href="#" route-path="manage-all-events" id="manage-all-events">Manage Events</a> 
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>User Management</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded"> 
                <a class="collapse-item" href="#" route-path="create-users" id="create-users">Create User</a>
                <a class="collapse-item" href="#" route-path="manage-all-users" id="manage-all-users">Manage Users</a> 
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Settings</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">General Settings</h6>
                <a class="collapse-item" href="#" route-path="display-settings" id="display-settings">Display Settings</a> 
                <a class="collapse-item" href="#" route-path="notification-settings" id="notification-settings">Notification Settings</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Privacy Settings:</h6>
                <a class="collapse-item" href="#" route-path="account-settings" id="account-settings">Account Profile</a>
                <a class="collapse-item" href="#" route-path="password-settings" id="password-settings">Password Settings</a>
                <a class="collapse-item" href="#" route-path="authentication-settings" id="authentication-settings">Authentication Settings</a>
            </div>
        </div>
    </li> 

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->