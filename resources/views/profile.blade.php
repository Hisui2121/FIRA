<x-layout>

<x-slot:title>
    My Profile
</x-slot:title>

<div class="hero">
    <div class="profile-container">
        <!-- TOP PROFILE CARD -->
        <div class="profile-card">
            <!-- AVATAR -->
            <div class="profile-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}

            </div>
            <!-- USER INFO -->
            <div class="profile-info">
                <h2> {{ auth()->user()->name }}</h2>
                <p> {{ auth()->user()->email }} </p>

                <!-- ROLE -->
                <div class="role-badge">  {{ auth()->user()->roles->first()->name }}</div>

            </div>

        </div>

        <!-- DETAILS -->
        <div class="profile-details">

            <div class="details-header">
                Account Information
            </div>

            <div class="details-grid">

                <div class="detail-item">
                    <span>Full Name</span>
                    <strong>{{ auth()->user()->name }}</strong>
                </div>

                <div class="detail-item">
                    <span>Email Address</span>
                    <strong>{{ auth()->user()->email }}</strong>
                </div>

                <div class="detail-item">
                    <span>Role</span>
                    <strong>
                        {{ auth()->user()->roles->first()->name }}
                    </strong>
                </div>

                <div class="detail-item">
                    <span>Joined</span>
                    <strong>
                        {{ auth()->user()->created_at->format('F d, Y') }}
                    </strong>
                </div>

            </div>

        </div>

        <!-- ACTIONS -->
        <div class="profile-actions">

            <a href="#" class="btn-secondary">
                Change Password
            </a>

            <a href="#" class="btn-primary">
                Edit Profile
            </a>

        </div>

    </div>

</div>

</x-layout>