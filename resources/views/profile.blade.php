<!-- PROFILE PHOTO MODAL -->
<div class="modal-overlay" id="profilePhotoModal">

    <div class="modern-modal">

        <div class="modal-header">
            <h3>Update Profile Photo</h3>

            <button type="button"
                    class="modal-close"
                    onclick="closeModal('profilePhotoModal')">
                ✕
            </button>
        </div>

        <form action="{{ route('profile.photo.update') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="upload-preview">

                @if(auth()->user()->profile_photo)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                         class="preview-avatar">
                @else
                    <div class="preview-avatar placeholder-avatar">
                        {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                    </div>
                @endif

            </div>

            <label class="upload-box">

                <input type="file"
                       name="profile_photo"
                       hidden>

                <span>Choose Profile Photo</span>

            </label>

            <button type="submit" class="btn btn-primary modal-btn">
                Save Changes
            </button>

        </form>

    </div>

</div>

<!-- COVER PHOTO MODAL -->
<div class="modal-overlay" id="coverPhotoModal">

    <div class="modern-modal">

        <div class="modal-header">
            <h3>Update Cover Photo</h3>

            <button type="button"
                    class="modal-close"
                    onclick="closeModal('coverPhotoModal')">
                ✕
            </button>
        </div>

        <form action="{{ route('profile.cover.update') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="cover-preview-box">

                @if(auth()->user()->cover_photo)
                    <img src="{{ asset('storage/' . auth()->user()->cover_photo) }}"
                         class="cover-preview-img">
                @else
                    <div class="cover-preview-placeholder">
                        No Cover Photo
                    </div>
                @endif

            </div>

            <label class="upload-box">

                <input type="file"
                       name="cover_photo"
                       hidden>

                <span>Choose Cover Photo</span>

            </label>

            <button type="submit"
                    class="btn btn-primary modal-btn">

                Save Changes

            </button>

        </form>

    </div>

</div>

<script>

function openModal(id) {

    document.getElementById(id).classList.add('active');

    document.body.classList.add('modal-open');
}

function closeModal(id) {

    document.getElementById(id).classList.remove('active');

    document.body.classList.remove('modal-open');
}

/* CLOSE IF CLICK OUTSIDE */
document.querySelectorAll('.modal-overlay').forEach(modal => {

    modal.addEventListener('click', function(e) {

        if(e.target === modal) {

            modal.classList.remove('active');

            document.body.classList.remove('modal-open');
        }

    });

});

</script>

<x-layout>
<x-slot:title>
    My Profile
</x-slot:title>

<div class="profile-page">

    <!-- HERO -->
    <div class="profile-hero">

        <!-- COVER -->
        <div class="profile-cover">

            @if(auth()->user()->cover_photo)

                <img src="{{ asset('storage/' . auth()->user()->cover_photo) }}"
                     alt="Cover">

            @else

                <div class="cover-placeholder">
                    No Cover Photo
                </div>

            @endif

            <!-- COVER ACTION -->
            <button class="cover-upload-btn"
                    onclick="openModal('coverPhotoModal')">
                Change Cover
            </button>

        </div>

        <!-- MAIN -->
        <div class="profile-main">

            <!-- AVATAR -->
            <div class="profile-avatar-wrapper">

                @if(auth()->user()->profile_photo)

                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                         class="profile-avatar-img">

                @else

                    <div class="profile-avatar">

                        {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}

                    </div>

                @endif

                <button class="avatar-upload-btn"
                        onclick="openModal('profilePhotoModal')">
                    Edit
                </button>

            </div>

            <!-- USER -->
            <div class="profile-user">

                <div class="profile-top">

                    <div>

                        <h1>
                            {{ auth()->user()->full_name }}
                        </h1>

                        <p>
                            {{ auth()->user()->email }}
                        </p>

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

        <!-- PERSONAL -->
        <div class="profile-section">

            <div class="section-header">

                <h3>Personal Information</h3>

                <p>
                    Your account and contact information.
                </p>

            </div>

            <div class="info-list">

                <div class="info-item">
                    <span>Full Name</span>

                    <strong>
                        {{ auth()->user()->full_name }}
                    </strong>
                </div>

                <div class="info-item">
                    <span>Email Address</span>

                    <strong>
                        {{ auth()->user()->email }}
                    </strong>
                </div>

                <div class="info-item">
                    <span>Phone Number</span>

                    <strong>
                        {{ auth()->user()->phone_number ?? 'Not Set' }}
                    </strong>
                </div>

                <div class="info-item">
                    <span>Birthdate</span>

                    <strong>

                        {{ auth()->user()->birthdate
                            ? auth()->user()->birthdate->format('F d, Y')
                            : 'Not Set'
                        }}

                    </strong>
                </div>

                <div class="info-item">
                    <span>Sex</span>

                    <strong>
                        {{ auth()->user()->sex ?? 'Not Set' }}
                    </strong>
                </div>

            </div>

        </div>

        <!-- ADDRESS -->
        <div class="profile-section">

            <div class="section-header">

                <h3>Address Information</h3>

                <p>
                    Residential address details.
                </p>

            </div>

            <div class="info-list">

                <div class="info-item">

                    <span>House No.</span>

                    <strong>
                        {{ auth()->user()->house_no ?? 'Not Set' }}
                    </strong>

                </div>

                <div class="info-item">

                    <span>Street</span>

                    <strong>
                        {{ auth()->user()->street ?? 'Not Set' }}
                    </strong>

                </div>

                <div class="info-item">

                    <span>Barangay</span>

                    <strong>
                        {{ auth()->user()->barangay ?? 'Not Set' }}
                    </strong>

                </div>

                <div class="info-item">

                    <span>City</span>

                    <strong>
                        {{ auth()->user()->city ?? 'Not Set' }}
                    </strong>

                </div>

            </div>

        </div>

    </div>

    <!-- ACTIONS -->
    <div class="profile-actions-modern">

        <a href="{{ route('settings.account')}}"
           class="profile-action-btn primary-action">

            Edit Profile

        </a>

        <a href="#"
           class="profile-action-btn secondary-action">

            Change Password

        </a>

    </div>

</div>

</x-layout>