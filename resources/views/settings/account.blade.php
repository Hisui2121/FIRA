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
                    Manage your personal information, profile details,
                    and account security.
                </p>
            </div>

        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="account-layout">

                <div class="account-main">

                    <!-- PROFILE INFORMATION -->
                    <div class="settings-panel">

                        <div class="panel-header">
                            <h3>Profile Information</h3>

                            <p>
                                Update your account details and contact information.
                            </p>
                        </div>

                        <!-- PROFILE IMAGE -->
                        <div class="avatar-section">

                            <div class="profile-avatar-wrapper">

                                @if(auth()->user()->profile_photo)
                                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                                         class="profile-avatar-img">
                                @else
                                    <div class="profile-avatar">
                                        {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                                    </div>
                                @endif

                            </div>

                            <div>

                                <label class="upload-btn">

                                    Upload Photo

                                    <input type="file"
                                           name="profile_photo"
                                           hidden>

                                </label>

                                <p class="helper-text">
                                    JPG or PNG. Max size 2MB.
                                </p>

                            </div>

                        </div>

                        <!-- BASIC INFO -->
                        <div class="form-grid">

                            <div class="form-group">
                                <label>First Name</label>

                                <input type="text"
                                       name="first_name"
                                       value="{{ old('first_name', auth()->user()->first_name) }}">
                            </div>

                            <div class="form-group">
                                <label>Last Name</label>

                                <input type="text"
                                       name="last_name"
                                       value="{{ old('last_name', auth()->user()->last_name) }}">
                            </div>

                            <div class="form-group">
                                <label>Email Address</label>

                                <input type="email"
                                       name="email"
                                       value="{{ old('email', auth()->user()->email) }}">
                            </div>

                            <div class="form-group">
                                <label>Phone Number</label>

                                <input type="text"
                                       name="phone_number"
                                       value="{{ old('phone_number', auth()->user()->phone_number) }}">
                            </div>

                            <div class="form-group">
                                <label>Birthdate</label>

                                <input type="date"
                                       name="birthdate"
                                       value="{{ old('birthdate', auth()->user()->birthdate) }}">
                            </div>

                            <div class="form-group">
                                <label>Sex</label>

                                <select name="sex">

                                    <option value="">Select Sex</option>

                                    <option value="male"
                                        {{ auth()->user()->sex == 'male' ? 'selected' : '' }}>
                                        Male
                                    </option>

                                    <option value="female"
                                        {{ auth()->user()->sex == 'female' ? 'selected' : '' }}>
                                        Female
                                    </option>

                                </select>
                            </div>

                        </div>

                    </div>

                    <!-- ADDRESS -->
                    <div class="settings-panel">

                        <div class="panel-header">
                            <h3>Address Information</h3>

                            <p>
                                Your residential address and location details.
                            </p>
                        </div>

                        <div class="form-grid">

                            <div class="form-group">
                                <label>House No.</label>

                                <input type="text"
                                       name="house_no"
                                       value="{{ old('house_no', auth()->user()->house_no) }}">
                            </div>

                            <div class="form-group">
                                <label>Street</label>

                                <input type="text"
                                       name="street"
                                       value="{{ old('street', auth()->user()->street) }}">
                            </div>

                            <div class="form-group">
                                <label>Barangay</label>

                                <input type="text"
                                       name="barangay"
                                       value="{{ old('barangay', auth()->user()->barangay) }}">
                            </div>

                            <div class="form-group">
                                <label>City</label>

                                <input type="text"
                                       name="city"
                                       value="{{ old('city', auth()->user()->city) }}">
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

                <div class="account-sidebar">

                    <!-- ACCOUNT SUMMARY -->
                    <div class="settings-panel">

                        <div class="panel-header">
                            <h3>Account Summary</h3>
                        </div>

                        <div class="summary-list">

                            <div class="summary-item">
                                <span>Full Name</span>

                                <strong>
                                    {{ auth()->user()->first_name }}
                                    {{ auth()->user()->last_name }}
                                </strong>
                            </div>

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

                    <!-- SAVE -->
                    <div class="settings-panel">

                        <div class="panel-header">

                            <h3>Save Changes</h3>

                            <p>
                                Ensure all information is accurate before saving.
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

</div>

</x-layout>