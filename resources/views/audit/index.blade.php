<x:layout>

<x-slot:title>Audit Logs</x-slot:title>

<div class="page-header">
    <h2>Audit Trail</h2>
    <p>Track all system activities and inventory changes.</p>
</div>

<div class="card">

    <div class="card-body">

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
                        <span class="badge badge-action">
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

</x:layout>