<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIRA — Create Account</title>
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

        /* STEPPER */
        .stepper { display: flex; align-items: center; margin-bottom: 40px; }
        .step { display: flex; flex-direction: column; align-items: center; gap: 8px; }
        .step-circle { width: 44px; height: 44px; border-radius: 50%; border: 2px solid var(--border); display: flex; align-items: center; justify-content: center; font-family: 'Bricolage Grotesque', sans-serif; font-weight: 700; font-size: 0.95rem; color: var(--gray); background: var(--white); transition: all 0.3s ease; }
        .step-circle.active { background: var(--dark); border-color: var(--dark); color: var(--white); }
        .step-label { font-size: 0.75rem; color: var(--gray); font-weight: 500; white-space: nowrap; }
        .step-label.active { color: var(--dark); font-weight: 600; }
        .step-line { width: 100px; height: 1.5px; background: var(--border); margin-bottom: 26px; }

        /* CARD */
        .form-card { background: var(--white); border-radius: 24px; padding: 40px 44px; width: 100%; box-shadow: var(--shadow); animation: fadeUp 0.6s cubic-bezier(0.22,1,0.36,1) forwards; opacity: 0; }
        .form-card-title { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 700; font-size: 1.35rem; color: var(--dark); margin-bottom: 28px; }

        /* FIELDS */
        .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
        .field-row.single { grid-template-columns: 1fr; }
        .field { display: flex; flex-direction: column; gap: 7px; }
        .field label { font-size: 0.72rem; font-weight: 600; color: var(--gray); letter-spacing: 0.06em; text-transform: uppercase; }
        .field input { background: var(--input-bg); border: 1.5px solid transparent; border-radius: 10px; padding: 13px 16px; font-family: 'DM Sans', sans-serif; font-size: 0.92rem; color: var(--dark); outline: none; transition: all 0.2s ease; width: 100%; }
        .field input:focus { border-color: var(--yellow); background: var(--white); box-shadow: 0 0 0 3px rgba(253,191,41,0.15); }
        .field .input-wrap { position: relative; }
        .field .input-wrap input { padding-right: 44px; }
        .eye-btn { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--gray); font-size: 1rem; padding: 0; display: flex; align-items: center; }

        /* CHECKBOX */
        .checkbox-wrap { display: flex; align-items: center; gap: 10px; margin-top: 20px; font-size: 0.88rem; color: var(--gray); cursor: pointer; user-select: none; }
        .checkbox-wrap input[type="checkbox"] { display: none; }
        .custom-checkbox { width: 18px; height: 18px; border: 1.5px solid var(--border); border-radius: 5px; background: var(--input-bg); display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: all 0.2s ease; font-size: 0.7rem; }
        .checkbox-wrap a { color: var(--dark); font-weight: 600; }

        /* ERROR */
        .error-alert { background: #fff5f5; border: 1px solid #feb2b2; border-radius: 12px; padding: 14px 18px; margin-bottom: 20px; font-size: 0.88rem; color: var(--error); }
        .field-error { font-size: 0.78rem; color: var(--error); margin-top: 2px; }

        /* BUTTONS */
        .btn-row { display: flex; justify-content: flex-end; margin-top: 32px; }
        .btn-next { background: var(--yellow); color: var(--dark); border: none; padding: 13px 28px; border-radius: 100px; font-family: 'DM Sans', sans-serif; font-size: 0.9rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: all 0.25s ease; }
        .btn-next:hover { background: var(--yellow-hover); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(253,191,41,0.4); }

        .footer-link { margin-top: 28px; font-size: 0.88rem; color: var(--gray); }
        .footer-link a { color: var(--dark); font-weight: 600; text-decoration: none; }

        @keyframes fadeUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
        @media (max-width: 600px) { nav { padding: 16px 20px; } .form-card { padding: 28px 20px; } .field-row { grid-template-columns: 1fr; } .step-line { width: 60px; } }
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
            <div class="step-circle active">1</div>
            <span class="step-label active">Account Details</span>
        </div>
        <div class="step-line"></div>
        <div class="step">
            <div class="step-circle">2</div>
            <span class="step-label">Personal Details</span>
        </div>
        <div class="step-line"></div>
        <div class="step">
            <div class="step-circle">3</div>
            <span class="step-label">Review</span>
        </div>
    </div>

    <!-- ERROR MESSAGES -->
    @if($errors->any())
        <div class="error-alert" style="width:100%">
            @foreach($errors->all() as $error)
                <div>• {{ $error }}</div>
            @endforeach
        </div>
    @endif

    <!-- FORM CARD -->
    <div class="form-card">
        <h2 class="form-card-title">Account Details</h2>

        <form action="{{ route('register.step1.store') }}" method="POST">
            @csrf

            <!-- First & Last Name -->
            <div class="field-row">
                <div class="field">
                    <label>First Name</label>
                    <input type="text" name="first_name" placeholder="e.g. Juan" value="{{ old('first_name', session('register.first_name')) }}" required>
                    @error('first_name') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="field">
                    <label>Last Name</label>
                    <input type="text" name="last_name" placeholder="e.g. Dela Cruz" value="{{ old('last_name', session('register.last_name')) }}" required>
                    @error('last_name') <span class="field-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Email -->
            <div class="field-row single">
                <div class="field">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="e.g. juan@email.com" value="{{ old('email', session('register.email')) }}" required>
                    @error('email') <span class="field-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Password -->
            <div class="field-row">
                <div class="field">
                    <label>Password</label>
                    <div class="input-wrap">
                        <input type="password" name="password" id="password" placeholder="Min. 8 characters" required>
                        <button type="button" class="eye-btn" onclick="togglePass('password', this)">👁</button>
                    </div>
                    @error('password') <span class="field-error">{{ $message }}</span> @enderror
                </div>
                <div class="field">
                    <label>Confirm Password</label>
                    <div class="input-wrap">
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Min. 8 characters" required>
                        <button type="button" class="eye-btn" onclick="togglePass('password_confirmation', this)">👁</button>
                    </div>
                </div>
            </div>

            <!-- Terms & Conditions -->
            <label class="checkbox-wrap" onclick="toggleCheck(this)">
                <input type="checkbox" name="terms" id="terms" {{ old('terms') ? 'checked' : '' }}>
                <div class="custom-checkbox" id="chk-box">{{ old('terms') ? '✓' : '' }}</div>
                I have read and agreed to the <a href="#" onclick="return false;">terms and conditions</a>
            </label>
            @error('terms') <div class="field-error" style="margin-top:6px">{{ $message }}</div> @enderror

            <div class="btn-row">
                <button type="submit" class="btn-next">Next &nbsp;→</button>
            </div>
        </form>
    </div>

    <p class="footer-link">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
</div>

<script>
function togglePass(id, btn) {
    const input = document.getElementById(id);
    if (input.type === 'password') { input.type = 'text'; btn.textContent = '🙈'; }
    else { input.type = 'password'; btn.textContent = '👁'; }
}
function toggleCheck(label) {
    const checkbox = label.querySelector('input[type="checkbox"]');
    const box = document.getElementById('chk-box');
    checkbox.checked = !checkbox.checked;
    box.textContent = checkbox.checked ? '✓' : '';
    box.style.background = checkbox.checked ? '#241f26' : '';
    box.style.borderColor = checkbox.checked ? '#241f26' : '';
    box.style.color = checkbox.checked ? '#fdbf29' : '';
}
</script>

</body>
</html>