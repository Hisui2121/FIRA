<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIRA — Review Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700;12..96,800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --yellow: #fdbf29; --yellow-hover: #e6a800; --dark: #241f26;
            --gray: #6b7280; --light-bg: #f7f5f0; --white: #ffffff;
            --border: rgba(36,31,38,0.12); --input-bg: #f0eeea;
            --shadow: 0 4px 32px rgba(36,31,38,0.08);
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
        .step-circle { width: 44px; height: 44px; border-radius: 50%; border: 2px solid var(--border); display: flex; align-items: center; justify-content: center; font-family: 'Bricolage Grotesque', sans-serif; font-weight: 700; font-size: 0.95rem; color: var(--gray); background: var(--white); }
        .step-circle.active { background: var(--dark); border-color: var(--dark); color: var(--white); }
        .step-circle.done { background: var(--dark); border-color: var(--dark); color: var(--yellow); }
        .step-label { font-size: 0.75rem; color: var(--gray); font-weight: 500; white-space: nowrap; }
        .step-label.active { color: var(--dark); font-weight: 600; }
        .step-line { width: 100px; height: 1.5px; background: var(--border); margin-bottom: 26px; }
        .step-line.done { background: var(--dark); }

        .form-card { background: var(--white); border-radius: 24px; padding: 40px 44px; width: 100%; box-shadow: var(--shadow); animation: fadeUp 0.6s cubic-bezier(0.22,1,0.36,1) forwards; opacity: 0; }
        .form-card-title { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 700; font-size: 1.35rem; color: var(--dark); margin-bottom: 28px; }

        /* Review sections */
        .review-section { background: var(--input-bg); border-radius: 14px; padding: 20px 24px; margin-bottom: 16px; }
        .review-section-label { font-size: 0.72rem; font-weight: 600; color: var(--gray); letter-spacing: 0.07em; text-transform: uppercase; margin-bottom: 16px; }
        .review-row { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid rgba(36,31,38,0.06); }
        .review-row:last-child { border-bottom: none; padding-bottom: 0; }
        .review-key { font-size: 0.88rem; color: var(--gray); }
        .review-value { font-size: 0.88rem; color: var(--dark); font-weight: 500; text-align: right; max-width: 60%; }

        .btn-row { display: flex; justify-content: space-between; align-items: center; margin-top: 32px; }
        .btn-back { background: transparent; color: var(--dark); border: 1.5px solid var(--border); padding: 12px 24px; border-radius: 100px; font-family: 'DM Sans', sans-serif; font-size: 0.9rem; font-weight: 500; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; transition: all 0.2s ease; }
        .btn-back:hover { border-color: var(--dark); }
        .btn-submit { background: var(--yellow); color: var(--dark); border: none; padding: 13px 28px; border-radius: 100px; font-family: 'DM Sans', sans-serif; font-size: 0.9rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: all 0.25s ease; }
        .btn-submit:hover { background: var(--yellow-hover); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(253,191,41,0.4); }

        .footer-link { margin-top: 28px; font-size: 0.88rem; color: var(--gray); }
        .footer-link a { color: var(--dark); font-weight: 600; text-decoration: none; }

        @keyframes fadeUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
        @media (max-width: 600px) { nav { padding: 16px 20px; } .form-card { padding: 28px 20px; } .step-line { width: 60px; } }
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
            <div class="step-circle done">✓</div>
            <span class="step-label">Personal Details</span>
        </div>
        <div class="step-line done"></div>
        <div class="step">
            <div class="step-circle active">3</div>
            <span class="step-label active">Review</span>
        </div>
    </div>

    <div class="form-card">
        <h2 class="form-card-title">Review Your Details</h2>

        <!-- Account Information -->
        <div class="review-section">
            <div class="review-section-label">Account Information</div>
            <div class="review-row">
                <span class="review-key">Name</span>
                <span class="review-value">{{ strtoupper(session('register.first_name') . ' ' . session('register.last_name')) }}</span>
            </div>
            <div class="review-row">
                <span class="review-key">Email Address</span>
                <span class="review-value">{{ session('register.email') }}</span>
            </div>
            <div class="review-row">
                <span class="review-key">Password</span>
                <span class="review-value">••••••••••••</span>
            </div>
        </div>

        <!-- Personal Details -->
        <div class="review-section">
            <div class="review-section-label">Personal Details</div>
            <div class="review-row">
                <span class="review-key">Home Address</span>
                <span class="review-value">
                    {{ session('register.house_no') }}, {{ session('register.street') }},
                    {{ session('register.barangay') }}, {{ strtoupper(session('register.city')) }}
                </span>
            </div>
            <div class="review-row">
                <span class="review-key">Birthdate</span>
                <span class="review-value">{{ session('register.birthdate') }}</span>
            </div>
            <div class="review-row">
                <span class="review-key">Sex</span>
                <span class="review-value">{{ strtoupper(session('register.sex')) }}</span>
            </div>
            <div class="review-row">
                 <span class="review-key">Phone Number</span>
                 <span class="review-value">
                    +63 {{ session('register')['phone_number'] ?? '' }}
            </span>
            </div>

        </div>

        <form action="{{ route('register.step3.store') }}" method="POST">
            @csrf
            <div class="btn-row">
                <a href="{{ route('register.step2') }}" class="btn-back">← &nbsp;Back</a>
                <button type="submit" class="btn-submit">✓ &nbsp;Create Account</button>
            </div>
        </form>
    </div>

    <p class="footer-link">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
</div>

</body>
</html>