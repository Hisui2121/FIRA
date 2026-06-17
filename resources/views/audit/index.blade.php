<x-layout>

<x-slot:title>Audit Logs</x-slot:title>

<div class="page-header">
    <h2>Audit Trail</h2>
    <p>Track all system activities and inventory changes.</p>
</div>

<div class="card">

    <div class="card-body">

            <div class="page-header">

                <div>

                    <h2>Audit Trail</h2>

                    <p>
                        Track all system activities and inventory changes.
                    </p>

                </div>

                <form action="{{ route('audit.clear') }}"
                    method="POST">

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-danger"
                        onclick="return confirm('This will permanently delete ALL audit logs. Continue?')">

                        Clear Logs

                    </button>

                </form>

          </div>

    <div class="card mb-4">

    <div class="card-body">

        <form method="GET" class="audit-toolbar" id = "searchForm">

        <input
            type="text"
            name="search"
            id="searchInput"
            value="{{ request('search') }}"
            placeholder="Search logs...">


            <select name="action">

                <option value="">All Actions</option>

                @foreach($actions as $action)

                    <option value="{{ $action }}"
                        {{ request('action') == $action ? 'selected' : '' }}>

                        {{ $action }}

                    </option>

                @endforeach

            </select>

            <select name="module">

                <option value="">All Modules</option>

                @foreach($modules as $module)

                    <option value="{{ $module }}"
                        {{ request('module') == $module ? 'selected' : '' }}>

                        {{ $module }}

                    </option>

                @endforeach

            </select>

            <button type="submit" class="btn">
                Filter
            </button>

            <a href="{{ route('audit.index') }}"
               class="btn">
                Reset
            </a>

        </form>

    </div>

</div>
    
        <table class="audit-table">

            <thead>
                <tr>
                    <th>User</th>
                    <th>Action</th>
                    <th>Module</th>
                    <th>Description</th>
                    <th>IP Address</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>

                @forelse($logs as $log)

                <tr>

                    <td>
                        {{ $log->user->name ?? 'System' }}
                    </td>

                    <td>
                        <span class="badge
                            @if($log->action === 'CREATE')
                                badge-success
                            @elseif($log->action === 'UPDATE')
                                badge-warning
                            @elseif($log->action === 'DELETE')
                                badge-danger
                            @else
                                badge-info
                            @endif
                            ">
                                {{ $log->action }}
                        </span>
                    </td>

                    <td>
                        {{ $log->module }}
                    </td>

                    <td>
                        {{ $log->description }}
                    </td>

                    <td>
                        {{ $log->ip_address }}
                    </td>

                    <td>
                        {{ $log->created_at->format('M d, Y h:i A') }}
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6">
                        No audit logs found.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

        <br>

        {{ $logs->links() }}

    </div>

</div>
<script>
    let timer;

    document.getElementById('searchInput')
        .addEventListener('input', function() {

            clearTimeout(timer);

            timer = setTimeout(() => {

                document.getElementById('searchForm').submit();

            }, 500);

    });
</script>
</x-layout>