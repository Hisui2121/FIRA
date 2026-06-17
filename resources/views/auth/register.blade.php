<x-layout>
<x-slot:title>Register</x-slot:title>

<div class="register-page">

    {{-- ===== SUCCESS STATE ===== --}}
    @if($step === 'success')
    <div class="register-success-wrap">
        <div class="register-card">
            <div class="success-icon">✓</div>
            <h2>Account Created!</h2>
            <p>Welcome to FIRA. Your account has been successfully created.<br>You can now log in and start managing your inventory.</p>
            <a href="/login" class="reg-btn">Go to Login</a>
        </div>
    </div>

    @else
    <div class="register-wrap">

        {{-- Header --}}
        <div class="register-header">
            <h2>Great!</h2>
            <p>Time to organize your fashion inventory</p>
        </div>

        {{-- Step Indicator --}}
        <div class="step-indicator">
            <div class="step-item {{ $step >= 1 ? 'active' : '' }} {{ $step > 1 ? 'done' : '' }}">
                <div class="step-circle">{{ $step > 1 ? '✓' : '1' }}</div>
                <span>Account Details</span>
            </div>
            <div class="step-line {{ $step > 1 ? 'active' : '' }}"></div>
            <div class="step-item {{ $step >= 2 ? 'active' : '' }} {{ $step > 2 ? 'done' : '' }}">
                <div class="step-circle">{{ $step > 2 ? '✓' : '2' }}</div>
                <span>Personal Details</span>
            </div>
            <div class="step-line {{ $step > 2 ? 'active' : '' }}"></div>
            <div class="step-item {{ $step >= 3 ? 'active' : '' }}">
                <div class="step-circle">3</div>
                <span>Review</span>
            </div>
        </div>

        {{-- Errors --}}
        @if($errors->any())
        <div class="error-box">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- ===== STEP 1: Account Details ===== --}}
        @if($step == 1)
        <div class="register-card">
            <h3 class="card-title">Account Details</h3>
            <form action="/register" method="POST">
                @csrf
                <input type="hidden" name="step" value="1">

                <div class="form-row">
                    <div class="form-group">
                        <label>FIRST NAME</label>
                        <input type="text" name="first_name"
                            value="{{ old('first_name', session('register.first_name')) }}"
                            placeholder="e.g. Juan">
                    </div>
                    <div class="form-group">
                        <label>LAST NAME</label>
                        <input type="text" name="last_name"
                            value="{{ old('last_name', session('register.last_name')) }}"
                            placeholder="e.g. Dela Cruz">
                    </div>
                </div>

                <div class="form-group">
                    <label>EMAIL ADDRESS</label>
                    <input type="email" name="email"
                        value="{{ old('email', session('register.email')) }}"
                        placeholder="e.g. juan@email.com">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>PASSWORD</label>
                        <input type="password" name="password"
                            placeholder="Min. 8 Characters">
                    </div>
                    <div class="form-group">
                        <label>CONFIRM PASSWORD</label>
                        <input type="password" name="password_confirmation"
                            placeholder="Min. 8 Characters">
                    </div>
                </div>

                <div class="form-actions">
                    <span></span>
                    <button type="submit" class="reg-btn">Next →</button>
                </div>
            </form>
        </div>

        {{-- ===== STEP 2: Personal Details ===== --}}
        @elseif($step == 2)
        <div class="register-card">
            <h3 class="card-title">Personal Details</h3>
            <form action="/register" method="POST">
                @csrf
                <input type="hidden" name="step" value="2">

                <p class="section-label">HOME ADDRESS</p>
                <div class="form-row form-row-4">
                    <div class="form-group">
                        <label>CITY</label>
                        <input type="text" name="city"
                            value="{{ old('city', session('register.city')) }}"
                            placeholder="e.g. Taguig City">
                    </div>
                    <div class="form-group">
                        <label>BARANGAY</label>
                        <input type="text" name="barangay"
                            value="{{ old('barangay', session('register.barangay')) }}"
                            placeholder="e.g. New Lower Bicutan">
                    </div>
                    <div class="form-group">
                        <label>STREET</label>
                        <input type="text" name="street"
                            value="{{ old('street', session('register.street')) }}"
                            placeholder="e.g. M.L Quezon Street">
                    </div>
                    <div class="form-group">
                        <label>HOUSE NO.</label>
                        <input type="text" name="house_no"
                            value="{{ old('house_no', session('register.house_no')) }}"
                            placeholder="e.g. 133">
                    </div>
                </div>

                <p class="section-label" style="margin-top:1.25rem;">OTHER DETAILS</p>
                <div class="form-row">
                    <div class="form-group">
                        <label>BIRTHDATE</label>
                        <input type="date" name="birthdate"
                            value="{{ old('birthdate', session('register.birthdate')) }}">
                    </div>
                    <div class="form-group">
                        <label>SEX</label>
                        <div class="sex-toggle">
                            <label class="sex-option">
                                <input type="radio" name="sex" value="Male"
                                    {{ old('sex', session('register.sex')) == 'Male' ? 'checked' : '' }}>
                                <span>Male</span>
                            </label>
                            <label class="sex-option">
                                <input type="radio" name="sex" value="Female"
                                    {{ old('sex', session('register.sex')) == 'Female' ? 'checked' : '' }}>
                                <span>Female</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>PHONE NUMBER</label>
                        <input type="text" name="phone"
                            value="{{ old('phone', session('register.phone')) }}"
                            placeholder="+63 9XX XXX XXXX">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button"
                        onclick="document.getElementById('back-to-1').submit()"
                        class="reg-btn-outline">← Back</button>
                    <button type="submit" class="reg-btn">Next →</button>
                </div>
            </form>

            {{-- Hidden back form to step 1 --}}
            <form id="back-to-1" action="{{ route('register.back') }}" method="POST" style="display:none;">
                @csrf
                <input type="hidden" name="go_to_step" value="1">
            </form>
        </div>

        {{-- ===== STEP 3: Review ===== --}}
        @elseif($step == 3)
        @php $d = session('register'); @endphp
        <div class="register-card">
            <h3 class="card-title">Review Your Details</h3>
            <form action="/register" method="POST">
                @csrf
                <input type="hidden" name="step" value="3">

                <div class="review-section">
                    <p class="review-section-title">ACCOUNT INFORMATION</p>
                    <div class="review-row">
                        <span class="review-label">Name</span>
                        <span class="review-value">
                            {{ strtoupper($d['first_name'] . ' ' . $d['last_name']) }}
                        </span>
                    </div>
                    <div class="review-row">
                        <span class="review-label">Email Address</span>
                        <span class="review-value">{{ $d['email'] }}</span>
                    </div>
                    <div class="review-row">
                        <span class="review-label">Password</span>
                        <span class="review-value">••••••••••••</span>
                    </div>
                </div>

                <div class="review-section">
                    <p class="review-section-title">PERSONAL DETAILS</p>
                    <div class="review-row">
                        <span class="review-label">Home Address</span>
                        <span class="review-value">
                            {{ strtoupper($d['house_no'] . ', ' . $d['street'] . ', ' . $d['barangay'] . ', ' . $d['city']) }}
                        </span>
                    </div>
                    <div class="review-row">
                        <span class="review-label">Birthdate</span>
                        <span class="review-value">{{ $d['birthdate'] }}</span>
                    </div>
                    <div class="review-row">
                        <span class="review-label">Sex</span>
                        <span class="review-value">{{ strtoupper($d['sex']) }}</span>
                    </div>
                    <div class="review-row">
                        <span class="review-label">Phone Number</span>
                        <span class="review-value">{{ $d['phone'] }}</span>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button"
                        onclick="document.getElementById('back-to-2').submit()"
                        class="reg-btn-outline">← Back</button>
                    <button type="submit" class="reg-btn">✓ Create Account</button>
                </div>
            </form>

            {{-- Hidden back form to step 2 --}}
            <form id="back-to-2" action="{{ route('register.back') }}" method="POST" style="display:none;">
                @csrf
                <input type="hidden" name="go_to_step" value="2">
            </form>
        </div>
        @endif

        <p class="register-bottom-text">
            Already have an account? <a href="/login">Sign In</a>
        </p>

    </div>
    @endif

</div>
</x-layout>