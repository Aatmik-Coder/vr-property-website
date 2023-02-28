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
                <a href="{{ route('admin.properties.index') }}">All properties</a>
            </li>

            <li>
                <a href="{!! route('admin.properties.create') !!}">Properties</a>
            </li>
        {{-- @endif --}}

        @elseif(auth('developer')->check())
            <li>
                <a href="{{ route('developer.dashboard') }}">Dashboard</a>
            </li>
            
            <li>
                <a href="{{ route('developer.properties.index') }}">All properties</a>
            </li>

            <li>
                <a href="{!! route('developer.properties.create') !!}">Properties</a>
            </li>

            <li>
                <a href="{{ route('developer.assign-properties.index') }}">All Assigned properties</a>
            </li>

            <li>
                <a href="{!! route('developer.assign-properties.create') !!}">Assign Properties</a>
            </li>
        {{-- @endif --}}

        @elseif(auth('agency')->check())
            <li>
                <a href="{{ route('agency.dashboard') }}">Dashboard</a>
            </li>

        @elseif(auth('employee')->check())
            <li>
                <a href="{{ route('employee.dashboard') }}">Dashboard</a>
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
