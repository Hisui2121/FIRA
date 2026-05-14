<x-layout>

<x-slot:title>
    User Management
</x-slot:title>

<div class="users-page">

    <!-- HEADER -->
    <div class="users-header">

        <div>
            <h1>Users</h1>
            <p>Manage staff accounts and permissions.</p>
        </div>

        <a href="{{ route('users.create') }}"
           class="btn btn-primary">
            + Add User
        </a>

    </div>

    <!-- FILTER BAR -->
    <div class="users-toolbar">

        <form method="GET" class="users-filter">

            <input type="text"
                   name="search"
                   placeholder="Search users..."
                   value="{{ request('search') }}">

            <select name="role">

                <option value="">All Roles</option>

                @foreach($roles as $role)

                    <option value="{{ $role->name }}"
                        {{ request('role') == $role->name ? 'selected' : '' }}>

                        {{ ucfirst($role->name) }}

                    </option>

                @endforeach

            </select>

            <button type="submit" class="btn">
                Filter
            </button>

        </form>

    </div>

    <!-- TABLE -->
    <div class="users-table-card">

        <table class="users-table">

            <thead>

                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Joined</th>
                    <th>Status</th>
                    <th></th>
                </tr>

            </thead>

            <tbody>

                @foreach($users as $user)

                    <tr>

                        <!-- USER -->
                        <td>

                            <div class="user-cell">

                                <div class="user-avatar">

                                    {{ strtoupper(substr($user->name, 0, 1)) }}

                                </div>

                                <div>

                                    <strong>{{ $user->name }}</strong>

                                    <p>{{ $user->email }}</p>

                                </div>

                            </div>

                        </td>

                        <!-- ROLE -->
                        <td>

                            <span class="role-pill">

                                {{ ucfirst($user->roles->first()?->name ?? 'No Role') }}

                            </span>

                        </td>

                        <!-- DATE -->
                        <td>

                            {{ $user->created_at->format('M d, Y') }}

                        </td>

                        <!-- STATUS -->
                        <td>

                            <span class="status-active">
                                Active
                            </span>

                        </td>

                        <!-- ACTIONS -->
                        <td>

                            <div class="table-actions">

                                <a href="{{ route('users.edit', $user->id) }}"
                                   class="btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('users.destroy', $user->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn-sm danger-btn"
                                            onclick="return confirm('Delete this user?')">

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div class="pagination-wrapper">

        {{ $users->links() }}

    </div>

</div>

</x-layout>