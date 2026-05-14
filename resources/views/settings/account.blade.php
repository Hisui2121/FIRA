<x-layout>

<x-slot:title>
    Account Settings
</x-slot:title>

<div class="settings-layout">

@include('settings.sidebar')

<div class="settings-page">

    <!-- HEADER -->
    <div class="settings-header">

        <div>
            <h1>Account Settings</h1>
            <p>
                Manage your personal information and account security.
            </p>
        </div>

    </div>
    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif
    <form action="{{ route('profile.update') }}" method="POST">

        @csrf
        @method('PUT')

        <div class="account-layout">

          
            <div class="account-main">

                <!-- PROFILE SECTION -->
                <div class="settings-panel">

                    <div class="panel-header">
                        <h3>Profile Information</h3>
                        <p>
                            Update your personal details and email.
                        </p>
                    </div>

                    <!-- AVATAR -->
                    <div class="avatar-section">

                        <div class="profile-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <div>
                            <button type="button" class="btn-secondary">
                                Upload Photo
                            </button>

                            <p class="helper-text">
                                JPG or PNG. Max size 2MB.
                            </p>
                        </div>

                    </div>

                    <!-- FORM GRID -->
                    <div class="form-grid">

                        <div class="form-group">
                            <label>Full Name</label>

                            <input type="text"
                                   name="name"
                                   value="{{ old('name', auth()->user()->name) }}">
                        </div>

                        <div class="form-group">
                            <label>Email Address</label>

                            <input type="email"
                                   name="email"
                                   value="{{ old('email', auth()->user()->email) }}">
                        </div>

                    </div>

                </div>

                <!-- PASSWORD -->
                <div class="settings-panel">

                    <div class="panel-header">
                        <h3>Change Password</h3>
                        <p>
                            Keep your account secure with a strong password.
                        </p>
                    </div>

                    <div class="form-group">
                        <label>Current Password</label>

                        <input type="password"
                               name="current_password">
                    </div>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>New Password</label>

                            <input type="password"
                                   name="password">
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>

                            <input type="password"
                                   name="password_confirmation">
                        </div>

                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="account-sidebar">

                <!-- ACCOUNT SUMMARY -->
                <div class="settings-panel">

                    <div class="panel-header">
                        <h3>Account Summary</h3>
                    </div>

                    <div class="summary-list">

                        <div class="summary-item">
                            <span>Role</span>

                            <strong>
                                {{ ucfirst(auth()->user()->roles->first()->name) }}
                            </strong>
                        </div>

                        <div class="summary-item">
                            <span>Status</span>

                            <strong class="status-active">
                                Active
                            </strong>
                        </div>

                        <div class="summary-item">
                            <span>Joined</span>

                            <strong>
                                {{ auth()->user()->created_at->format('F d, Y') }}
                            </strong>
                        </div>

                    </div>

                </div>

                <!-- ACTIONS -->
                <div class="settings-panel">

                    <div class="panel-header">
                        <h3>Save Changes</h3>

                        <p>
                            Make sure your information is correct before saving.
                        </p>
                    </div>

                    <button type="submit"
                            class="save-btn">
                        Save Account Changes
                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

</x-layout>