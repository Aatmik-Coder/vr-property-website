<!-- Side Navbar -->
<nav class="side-navbar">
    <ul class="list-unstyled">
        <li @if(request()->routeIs('admin.dashboard')) class="active" @endif>
            <a href="{{ route('admin.dashboard') }}">
                <i class="fa fa-home"></i> Dashboard
            </a>
        </li>
        <li class="@if(request()->routeIs('admin.user.*')) active @endif">
            <a href="{{ route('admin.user.list') }}">
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
