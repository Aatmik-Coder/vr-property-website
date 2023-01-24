<!-- Side Navbar -->
<nav class="side-navbar">
    <!-- Sidebar Header-->
    <div class="sidebar-header d-flex align-items-center">
        <div class="avatar">
            <img src="{{ auth('admin')->user()->avatar_url }}" class="img-fluid rounded-circle">
        </div>
        <div class="title">
            <h1 class="h4">{{ ucwords(auth('admin')->user()->name) }}</h1>
            <p>{{ ucwords(auth('admin')->user()->type) }}</p>
        </div>
    </div>

    <!-- Sidebar Navidation Menus-->
    <ul class="list-unstyled">
        <li @if(request()->routeIs('admin.dashboard')) class="active" @endif>
            <a href="{{ route('admin.dashboard') }}">
                <i class="fa fa-home"></i> Dashboard
            </a>
        </li>
        <li class="@if(request()->routeIs('admin.user.*')) active @endif">
            <a href="javascript:void(0)">
                <i class="fa fa-users"></i> Users
            </a>
        </li>
        <li class="@if(request()->routeIs('admin.image.*')) active @endif">
            <a href="javascript:void(0)">
                <i class="fa fa-images"></i> Images
            </a>
        </li>
    </ul>
</nav>
