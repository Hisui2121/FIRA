<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIRA — Personal Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700;12..96,800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --yellow: #fdbf29; --yellow-hover: #e6a800; --dark: #241f26;
            --gray: #6b7280; --light-bg: #f7f5f0; --white: #ffffff;
            --border: rgba(36,31,38,0.12); --input-bg: #f0eeea;
            --error: #e53e3e; --shadow: 0 4px 32px rgba(36,31,38,0.08);
        }
        body { font-family: 'DM Sans', sans-serif; background: var(--light-bg); color: var(--dark); min-height: 100vh; }
        nav { display: flex; justify-content: space-between; align-items: center; padding: 18px 52px; background: var(--light-bg); border-bottom: 1px solid var(--border); position: sticky; top: 0; z-index: 100; }
        .logo { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 600; font-size: 1.55rem; color: var(--dark); text-decoration: none; letter-spacing: -0.5px; }
        .logo .dot { color: var(--yellow); }
        .page-wrap { max-width: 760px; margin: 0 auto; padding: 52px 24px 80px; display: flex; flex-direction: column; align-items: center; }
        .page-title { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; font-size: 2rem; color: var(--dark); margin-bottom: 6px; }
        .page-subtitle { font-size: 0.95rem; color: var(--gray); margin-bottom: 36px; }

        .stepper { display: flex; align-items: center; margin-bottom: 40px; }
        .step { display: flex; flex-direction: column; align-items: center; gap: 8px; }
        .step-circle { width: 44px; height: 44px; border-radius: 50%; border: 2px solid var(--border); display: flex; align-items: center; justify-content: center; font-family: 'Bricolage Grotesque', sans-serif; font-weight: 700; font-size: 0.95rem; color: var(--gray); background: var(--white); transition: all 0.3s ease; }
        .step-circle.active { background: var(--dark); border-color: var(--dark); color: var(--white); }
        .step-circle.done { background: var(--dark); border-color: var(--dark); color: var(--yellow); }
        .step-label { font-size: 0.75rem; color: var(--gray); font-weight: 500; white-space: nowrap; }
        .step-label.active { color: var(--dark); font-weight: 600; }
        .step-line { width: 100px; height: 1.5px; background: var(--border); margin-bottom: 26px; }
        .step-line.done { background: var(--dark); }

        .form-card { background: var(--white); border-radius: 24px; padding: 40px 44px; width: 100%; box-shadow: var(--shadow); animation: fadeUp 0.6s cubic-bezier(0.22,1,0.36,1) forwards; opacity: 0; }
        .form-card-title { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 700; font-size: 1.35rem; color: var(--dark); margin-bottom: 6px; }
        .section-label { font-size: 0.78rem; font-weight: 600; color: var(--gray); letter-spacing: 0.05em; text-transform: uppercase; margin: 24px 0 14px; border-bottom: 1px solid var(--border); padding-bottom: 8px; }

        .field-row { display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 14px; margin-bottom: 16px; }
        .field-row.two { grid-template-columns: 1fr 1fr; }
        .field-row.three { grid-template-columns: 1fr 1fr 1fr; }
        .field { display: flex; flex-direction: column; gap: 7px; }
        .field label { font-size: 0.72rem; font-weight: 600; color: var(--gray); letter-spacing: 0.06em; text-transform: uppercase; }
        .field input, .field select { background: var(--input-bg); border: 1.5px solid transparent; border-radius: 10px; padding: 13px 16px; font-family: 'DM Sans', sans-serif; font-size: 0.92rem; color: var(--dark); outline: none; transition: all 0.2s ease; width: 100%; }
        .field input:focus, .field select:focus { border-color: var(--yellow); background: var(--white); box-shadow: 0 0 0 3px rgba(253,191,41,0.15); }
        .field-error { font-size: 0.78rem; color: var(--error); margin-top: 2px; }

        /* Radio sex buttons */
        .radio-group { display: flex; gap: 10px; }
        .radio-option { flex: 1; display: flex; align-items: center; gap: 8px; background: var(--input-bg); border: 1.5px solid transparent; border-radius: 10px; padding: 12px 16px; cursor: pointer; transition: all 0.2s ease; font-size: 0.92rem; color: var(--dark); user-select: none; }
        .radio-option input[type="radio"] { display: none; }
        .radio-dot { width: 18px; height: 18px; border-radius: 50%; border: 2px solid var(--border); display: flex; align-items: center; justify-content: center; transition: all 0.2s ease; flex-shrink: 0; }
        .radio-option.selected { border-color: var(--yellow); background: rgba(253,191,41,0.08); }
        .radio-option.selected .radio-dot { border-color: var(--yellow); background: var(--yellow); }

        /* Phone prefix */
        .phone-wrap { display: flex; gap: 8px; }
        .phone-prefix { background: var(--input-bg); border: 1.5px solid transparent; border-radius: 10px; padding: 13px 14px; font-family: 'DM Sans', sans-serif; font-size: 0.92rem; color: var(--gray); white-space: nowrap; }

        .error-alert { background: #fff5f5; border: 1px solid #feb2b2; border-radius: 12px; padding: 14px 18px; margin-bottom: 20px; font-size: 0.88rem; color: var(--error); }

        .btn-row { display: flex; justify-content: space-between; align-items: center; margin-top: 32px; }
        .btn-back { background: transparent; color: var(--dark); border: 1.5px solid var(--border); padding: 12px 24px; border-radius: 100px; font-family: 'DM Sans', sans-serif; font-size: 0.9rem; font-weight: 500; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s ease; }
        .btn-back:hover { border-color: var(--dark); }
        .btn-next { background: var(--yellow); color: var(--dark); border: none; padding: 13px 28px; border-radius: 100px; font-family: 'DM Sans', sans-serif; font-size: 0.9rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: all 0.25s ease; }
        .btn-next:hover { background: var(--yellow-hover); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(253,191,41,0.4); }

        .footer-link { margin-top: 28px; font-size: 0.88rem; color: var(--gray); }
        .footer-link a { color: var(--dark); font-weight: 600; text-decoration: none; }

        @keyframes fadeUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
        @media (max-width: 600px) {
            nav { padding: 16px 20px; } .form-card { padding: 28px 20px; }
            .field-row { grid-template-columns: 1fr 1fr; } .field-row.two { grid-template-columns: 1fr; }
            .step-line { width: 60px; }
        }
    </style>
</head>
<body>

<nav>
    <a href="/" class="logo">fira<span class="dot">.</span></a>
</nav>

<div class="page-wrap">
    <h1 class="page-title">Great!</h1>
    <p class="page-subtitle">Time to organize your fashion inventory</p>

    <!-- STEPPER -->
    <div class="stepper">
        <div class="step">
            <div class="step-circle done">✓</div>
            <span class="step-label">Account Details</span>
        </div>
        <div class="step-line done"></div>
        <div class="step">
            <div class="step-circle active">2</div>
            <span class="step-label active">Personal Details</span>
        </div>
        <div class="step-line"></div>
        <div class="step">
            <div class="step-circle">3</div>
            <span class="step-label">Review</span>
        </div>
    </div>

    @if($errors->any())
        <div class="error-alert" style="width:100%">
            @foreach($errors->all() as $error)<div>• {{ $error }}</div>@endforeach
        </div>
    @endif

    <div class="form-card">
        <h2 class="form-card-title">Personal Details</h2>

        <form action="{{ route('register.step2.store') }}" method="POST">
            @csrf

            <!-- Home Address -->
            <div class="section-label">Home Address</div>
            <div class="field-row">
                <div class="field">
                    <label>City</label>
                    <input type="text" name="city" placeholder="e.g Taguig City" value="{{ old('city', session('register.city')) }}">
                    @error('city') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="field">
                    <label>Barangay</label>
                    <input type="text" name="barangay" placeholder="e.g New Lower Bicutan" value="{{ old('barangay', session('register.barangay')) }}">
                </div>
                <div class="field">
                    <label>Street</label>
                    <input type="text" name="street" placeholder="e.g M.L Quezon Street" value="{{ old('street', session('register.street')) }}">
                </div>
                <div class="field">
                    <label>House No.</label>
                    <input type="text" name="house_no" placeholder="e.g 133" value="{{ old('house_no', session('register.house_no')) }}">
                </div>
            </div>

            <!-- Other Details -->
            <div class="section-label">Other Details</div>
            <div class="field-row three">
                <div class="field">
                    <label>Birthdate</label>
                    <input type="date" name="birthdate" value="{{ old('birthdate', session('register.birthdate')) }}" required>
                    @error('birthdate') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="field">
                    <label>Sex</label>
                    <div class="radio-group">
                        <label class="radio-option {{ old('sex', session('register.sex')) == 'Male' ? 'selected' : '' }}" onclick="selectSex(this, 'Male')">
                            <input type="radio" name="sex" value="Male" {{ old('sex', session('register.sex')) == 'Male' ? 'checked' : '' }}>
                            <div class="radio-dot"></div> Male
                        </label>
                        <label class="radio-option {{ old('sex', session('register.sex')) == 'Female' ? 'selected' : '' }}" onclick="selectSex(this, 'Female')">
                            <input type="radio" name="sex" value="Female" {{ old('sex', session('register.sex')) == 'Female' ? 'checked' : '' }}>
                            <div class="radio-dot"></div> Female
                        </label>
                    </div>
                    @error('sex') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="field">
                    <label>Phone Number</label>
                    <div class="phone-wrap">
                        <span class="phone-prefix">+63</span>
                        <input type="text" name="phone_number"
                            placeholder="9XX XXX XXXX"
                            value="{{ old('phone_number', session('register')['phone_number'] ?? '') }}"
                            style="flex:1"
                            maxlength="10"
                            oninput="this.value=this.value.replace(/[^0-9]/g,'').replace(/^63/,'').substring(0,10)"
                            required>
                    </div>
                    @error('phone_number') <span class="field-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="btn-row">
                <a href="{{ route('register.step1') }}" class="btn-back">← &nbsp;Back</a>
                <button type="submit" class="btn-next">Next &nbsp;→</button>
            </div>
        </form>
    </div>

    <p class="footer-link">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
</div>

<script>
function selectSex(label, value) {
    document.querySelectorAll('.radio-option').forEach(el => {
        el.classList.remove('selected');
        el.querySelector('input').checked = false;
    });
    label.classList.add('selected');
    label.querySelector('input').checked = true;
}
</script>

</body>
</html>