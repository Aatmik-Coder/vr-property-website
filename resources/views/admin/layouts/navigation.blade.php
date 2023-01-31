<!-- Side Navbar -->
<nav class="side-navbar">
    <ul class="list-unstyled">
        <li @if(request()->routeIs('admin.dashboard')) class="active" @endif>
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="@if(request()->routeIs('admin.user.*')) active @endif">
            <a href="javascript:void(0)">Users</a>
        </li>
        <li class="@if(request()->routeIs('admin.image.*')) active @endif">
            <a href="javascript:void(0)">Images</a>
        </li>
    </ul>
</nav>
