<!-- Side Navbar -->
<nav class="side-navbar">
    <ul class="list-unstyled">
        @if (auth('admin')->check())
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li>
                <a href="/admin/users">All User</a>
            </li>
            
            <li>
                <a href="/admin/users/create">Add user</a>
            </li>
            
            <li>
                <a href="/admin/roles">All Roles</a>
            </li>
            
            <li>
                <a href="/admin/roles/create">add role</a>
            </li>

            <li>
                <a href="/admin/permissions">All Permission</a>
            </li>

            <li>
                <a href="/admin/permissions/create">add permission</a>
            </li>

            <li>
                <a href="{!! route('admin.properties.create') !!}">Properties</a>
            </li>
        @endif

        @if(auth('developer')->check())
            <li>
                <a href="{!! route('admin.properties.create') !!}">Properties</a>
            </li>
        @endif

        
        {{-- <li>
            <a href="/admin/developers/create">add developer</a>
        </li>
        
        <li>
            <a href="/admin/agencies/create">add agencies</a>
        </li> --}}
    </ul>
</nav>
