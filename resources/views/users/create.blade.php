<x-layout>

<x-slot:title>
    Create User
</x-slot:title>

<div class="form-page">

    <div class="page-header">
        <h1>Create User</h1>
        <p>Add a new system user account.</p>
    </div>

    <div class="form-card">

        <form action="{{ route('users.store') }}" method="POST">

            @csrf

            <!-- NAME -->
            <div class="form-group">
                <label>Name</label>

                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
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
                       value="{{ old('email') }}"
                       required>

                @error('email')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <!-- PASSWORD -->
            <div class="form-group">
                <label>Password</label>

                <input type="password"
                       name="password"
                       required>

                @error('password')
                    <small class="error">{{ $message }}</small>
                @enderror
            </div>

            <!-- ROLE -->
            <div class="form-group">
                <label>Role</label>

                <select name="role" required>

                    <option value="">
                        Select Role
                    </option>

                    @foreach($roles as $role)

                        <option value="{{ $role->name }}"
                            {{ old('role') == $role->name ? 'selected' : '' }}>

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
                    Create User
                </button>

            </div>

        </form>

    </div>

</div>

</x-layout>