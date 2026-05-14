<x-layout>

<x-slot:title>
    My Profile
</x-slot:title>

<div class="profile-page">

    <!-- PROFILE HERO -->
    <div class="profile-hero">

        <!-- COVER IMAGE -->
        <div class="profile-cover">

            @if(auth()->user()->cover_photo)
                <img src="{{ asset('storage/' . auth()->user()->cover_photo) }}"
                     alt="Cover Photo">
            @else
                <div class="cover-placeholder">
                    Cover Photo
                </div>
            @endif

            <!-- COVER UPLOAD BUTTON -->
            <button class="cover-upload-btn">
                Change Cover
            </button>

        </div>

        <!-- PROFILE MAIN -->
        <div class="profile-main">

            <!-- AVATAR -->
            <div class="profile-avatar-wrapper">

                @if(auth()->user()->profile_photo)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                         class="profile-avatar-img">
                @else
                    <div class="profile-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif

                <button class="avatar-upload-btn">
                    Edit
                </button>

            </div>

            <!-- USER INFO -->
            <div class="profile-user">

                <div class="profile-top">

                    <div>
                        <h1>{{ auth()->user()->name }}</h1>

                        <p>{{ auth()->user()->email }}</p>
                    </div>

                    <div class="role-badge">
                        {{ ucfirst(auth()->user()->roles->first()->name) }}
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="profile-grid">

        <!-- LEFT -->
        <div class="profile-section">

            <div class="section-header">
                <h3>Personal Information</h3>
                <p>Your account details and profile information.</p>
            </div>

            <div class="info-list">

                <div class="info-item">
                    <span>Full Name</span>
                    <strong>{{ auth()->user()->name }}</strong>
                </div>

                <div class="info-item">
                    <span>Email Address</span>
                    <strong>{{ auth()->user()->email }}</strong>
                </div>

                <div class="info-item">
                    <span>Role</span>
                    <strong>
                        {{ ucfirst(auth()->user()->roles->first()->name) }}
                    </strong>
                </div>

                <div class="info-item">
                    <span>Member Since</span>
                    <strong>
                        {{ auth()->user()->created_at->format('F d, Y') }}
                    </strong>
                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="profile-section">

            <div class="section-header">
                <h3>Quick Actions</h3>
                <p>Manage your account settings.</p>
            </div>

            <div class="action-list">

                <a href="#" class="profile-action-btn primary-action">
                    Edit Profile
                </a>

                <a href="#" class="profile-action-btn secondary-action">
                    Change Password
                </a>

                <a href="#" class="profile-action-btn secondary-action">
                    Upload Photo
                </a>

            </div>

        </div>

    </div>

</div>

</x-layout>