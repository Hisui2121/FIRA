<x-layout>

<x-slot:title>
    Edit User
</x-slot:title>

<div class="form-page">

    <div class="page-header">
        <h1>Edit User</h1>
        <p>Update user account information.</p>
    </div>

    <div class="form-card">

        <form action="{{ route('users.update', $user->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <!-- NAME -->
            <div class="form-group">
                <label>Name</label>

                <input type="text"
                       name="name"
                       value="{{ old('name', $user->name) }}"
                       required>

                @error('name')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <!-- EMAIL -->
            <div class="form-group">
                <label>Email</label>

                <input type="email"
                       name="email"
                       value="{{ old('email', $user->email) }}"
                       required>

                @error('email')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <!-- ROLE -->
            <div class="form-group">
                <label>Role</label>

                <select name="role" required>

                    @foreach($roles as $role)

                        <option value="{{ $role->name }}"
                            {{ $user->hasRole($role->name) ? 'selected' : '' }}>

                            {{ ucfirst($role->name) }}

                        </option>

                    @endforeach

                </select>

                @error('role')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-actions">

                <a href="{{ route('users.index') }}"
                   class="btn">
                    Cancel
                </a>

                <button type="submit"
                        class="btn btn-primary">
                    Update User
                </button>

            </div>

        </form>

    </div>

</div>

</x-layout>