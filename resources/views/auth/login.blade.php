<!DOCTYPE html>
<html lang="en" id="html-root">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIRA — Sign In</title>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700;12..96,800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --yellow: #fdbf29;
            --yellow-hover: #e6a800;
            --dark: #241f26;
            --gray: #6b7280;
            --light-bg: #f7f5f0;
            --white: #ffffff;
            --border: rgba(36,31,38,0.12);
            --input-bg: #f0eeea;
            --error: #e53e3e;
            --shadow: 0 4px 40px rgba(36,31,38,0.10);
        }

        [data-theme="dark"] {
            --dark: #f0ece8;
            --gray: #9ca3af;
            --light-bg: #1a1718;
            --white: #241f26;
            --border: rgba(255,255,255,0.1);
            --input-bg: #2a2528;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--light-bg);
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* ── NAVBAR ── */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 52px;
            background: var(--light-bg);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
            transition: background-color 0.3s ease;
        }

        .logo {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 600;
            font-size: 1.55rem;
            color: var(--dark);
            text-decoration: none;
            letter-spacing: -0.5px;
            transition: color 0.3s ease;
        }
        .logo .dot { color: var(--yellow); }

        .dark-toggle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1.5px solid var(--border);
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            transition: all 0.25s ease;
            color: var(--dark);
        }
        .dark-toggle:hover { background: var(--dark); color: var(--light-bg); border-color: var(--dark); }

        /* ── MAIN SPLIT LAYOUT ── */
        .main {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: calc(100vh - 61px);
        }

        /* ── LEFT — Fashion Image Panel ── */
        .image-panel {
            position: relative;
            overflow: hidden;
            background: var(--light-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px;
            animation: fadeIn 0.8s ease forwards;
            opacity: 0;
        }

        /* Fashion illustration using CSS shapes + fashion emoji/icons */
        .fashion-scene {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Ladder structure */
        .ladder {
            position: relative;
            width: 280px;
            height: 420px;
        }

        /* Left rail */
        .ladder::before {
            content: '';
            position: absolute;
            left: 30px;
            top: 0;
            bottom: 0;
            width: 14px;
            background: linear-gradient(180deg, #8B6914, #6B4F0F);
            border-radius: 7px;
            transform: skewX(-4deg);
        }

        /* Right rail */
        .ladder::after {
            content: '';
            position: absolute;
            right: 30px;
            top: 0;
            bottom: 0;
            width: 14px;
            background: linear-gradient(180deg, #8B6914, #6B4F0F);
            border-radius: 7px;
            transform: skewX(4deg);
        }

        /* Rungs */
        .rung {
            position: absolute;
            left: 44px;
            right: 44px;
            height: 10px;
            background: linear-gradient(90deg, #A07820, #C49A28, #A07820);
            border-radius: 5px;
        }
        .rung:nth-child(1) { top: 80px; }
        .rung:nth-child(2) { top: 170px; }
        .rung:nth-child(3) { top: 260px; }
        .rung:nth-child(4) { top: 350px; }

        /* Jacket hangers on the ladder */
        .hanger-group {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 0;
            align-items: flex-start;
        }

        .jacket {
            position: relative;
            transition: transform 0.4s ease;
        }

        .jacket:hover { transform: translateY(-6px) rotate(-2deg); }

        /* Jacket 1 — Beige/Cream */
        .jacket-1 {
            width: 100px;
            height: 140px;
            background: linear-gradient(160deg, #d4c8a8, #b8a87e);
            border-radius: 8px 8px 14px 14px;
            margin-top: 20px;
            margin-right: -18px;
            z-index: 1;
            box-shadow: -4px 4px 16px rgba(36,31,38,0.15);
            position: relative;
        }

        .jacket-1::before {
            content: '';
            position: absolute;
            top: 0; left: 50%;
            transform: translateX(-50%);
            width: 3px; height: 22px;
            background: #888; border-radius: 3px;
        }

        .jacket-1::after {
            content: '';
            position: absolute;
            top: 22px; left: 50%;
            transform: translateX(-50%);
            width: 28px; height: 6px;
            background: #c0a96e;
            border-radius: 3px;
        }

        /* Jacket 2 — Olive Green (front/center) */
        .jacket-2 {
            width: 110px;
            height: 155px;
            background: linear-gradient(160deg, #6b7a4a, #4a5632);
            border-radius: 8px 8px 16px 16px;
            margin-top: 0;
            z-index: 3;
            box-shadow: 0 8px 28px rgba(36,31,38,0.25);
            position: relative;
        }

        .jacket-2::before {
            content: '';
            position: absolute;
            top: 0; left: 50%;
            transform: translateX(-50%);
            width: 3px; height: 22px;
            background: #888; border-radius: 3px;
        }

        /* Collar details */
        .jacket-2::after {
            content: '';
            position: absolute;
            top: 22px; left: 50%;
            transform: translateX(-50%);
            width: 32px; height: 8px;
            background: #8a9a5e;
            border-radius: 4px;
        }

        /* Bag at bottom */
        .bag {
            position: absolute;
            bottom: -20px;
            right: 20px;
            width: 72px;
            height: 64px;
            background: linear-gradient(145deg, #c8894a, #a06030);
            border-radius: 8px 8px 12px 12px;
            box-shadow: 4px 6px 16px rgba(36,31,38,0.2);
            z-index: 4;
        }

        .bag::before {
            content: '';
            position: absolute;
            top: -12px; left: 50%;
            transform: translateX(-50%);
            width: 36px; height: 12px;
            border: 3px solid #c8894a;
            border-bottom: none;
            border-radius: 8px 8px 0 0;
        }

        /* Floating label tags */
        .tag {
            position: absolute;
            background: var(--white);
            border-radius: 10px;
            padding: 8px 14px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--dark);
            box-shadow: 0 4px 16px rgba(36,31,38,0.12);
            white-space: nowrap;
            animation: float 3s ease-in-out infinite;
            transition: background 0.3s;
        }

        .tag-1 { top: 60px; left: 20px; animation-delay: 0s; }
        .tag-2 { top: 180px; right: 10px; animation-delay: 1s; }
        .tag-3 { bottom: 80px; left: 10px; animation-delay: 2s; }

        .tag .dot-accent { color: var(--yellow); margin-right: 4px; }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }

        /* ── RIGHT — Form Panel ── */
        .form-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 60px;
            background: var(--light-bg);
            transition: background-color 0.3s ease;
        }

        .form-container {
            background: var(--white);
            border-radius: 24px;
            padding: 48px 44px;
            width: 100%;
            max-width: 460px;
            box-shadow: var(--shadow);
            animation: fadeUp 0.7s cubic-bezier(0.22,1,0.36,1) 0.1s forwards;
            opacity: 0;
            transition: background 0.3s ease;
        }

        .form-title {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 800;
            font-size: 2rem;
            color: var(--dark);
            margin-bottom: 8px;
            transition: color 0.3s ease;
        }

        .form-subtitle {
            font-size: 0.92rem;
            color: var(--gray);
            margin-bottom: 36px;
            line-height: 1.5;
        }

        /* ── ERROR ALERT ── */
        .error-alert {
            background: #fff5f5;
            border: 1px solid #feb2b2;
            border-radius: 12px;
            padding: 13px 16px;
            margin-bottom: 20px;
            font-size: 0.86rem;
            color: var(--error);
        }

        /* ── SUCCESS ALERT ── */
        .success-alert {
            background: #f0fff4;
            border: 1px solid #9ae6b4;
            border-radius: 12px;
            padding: 13px 16px;
            margin-bottom: 20px;
            font-size: 0.86rem;
            color: #276749;
        }

        /* ── FIELDS ── */
        .field {
            display: flex;
            flex-direction: column;
            gap: 7px;
            margin-bottom: 16px;
        }

        .field label {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--gray);
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .field .input-wrap { position: relative; }

        .field input {
            background: var(--input-bg);
            border: 1.5px solid transparent;
            border-radius: 10px;
            padding: 14px 16px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            color: var(--dark);
            outline: none;
            transition: all 0.2s ease;
            width: 100%;
        }

        .field input:focus {
            border-color: var(--yellow);
            background: var(--white);
            box-shadow: 0 0 0 3px rgba(253,191,41,0.15);
        }

        .field input.has-error { border-color: var(--error); }

        .field .eye-btn {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: var(--gray);
            font-size: 1rem;
            padding: 0;
            display: flex;
            align-items: center;
        }

        .field-error {
            font-size: 0.78rem;
            color: var(--error);
        }

        /* ── OPTIONS ROW ── */
        .options-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
            margin-top: 4px;
        }

        .keep-logged {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.86rem;
            color: var(--gray);
            cursor: pointer;
            user-select: none;
        }

        .keep-logged input[type="checkbox"] { display: none; }

        .custom-checkbox {
            width: 17px;
            height: 17px;
            border: 1.5px solid var(--border);
            border-radius: 5px;
            background: var(--input-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 0.2s ease;
            font-size: 0.65rem;
        }

        .forgot-link {
            font-size: 0.86rem;
            color: var(--yellow-hover);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .forgot-link:hover { color: var(--dark); }

        /* ── SIGN IN BUTTON ── */
        .btn-signin {
            background: var(--yellow);
            color: var(--dark);
            border: none;
            padding: 15px;
            border-radius: 100px;
            font-family: 'DM Sans', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
            transition: all 0.25s ease;
            margin-bottom: 20px;
            letter-spacing: -0.2px;
        }

        .btn-signin:hover {
            background: var(--yellow-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(253,191,41,0.4);
        }

        .btn-signin:active { transform: translateY(0); }

        /* ── FOOTER LINK ── */
        .footer-link {
            text-align: center;
            font-size: 0.88rem;
            color: var(--gray);
        }

        .footer-link a {
            color: var(--dark);
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-link a:hover { color: var(--yellow-hover); }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) {
            .main { grid-template-columns: 1fr; }
            .image-panel { display: none; }
            .form-panel { padding: 40px 24px; }
        }

        @media (max-width: 480px) {
            nav { padding: 16px 20px; }
            .form-container { padding: 36px 24px; }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav>
    <a href="/" class="logo">fira<span class="dot">.</span></a>
    <button class="dark-toggle" id="toggle-btn" onclick="toggleDark()" title="Toggle dark mode">🌙</button>
</nav>

<div class="main">

    <!-- LEFT — Fashion Scene -->
    <div class="image-panel">
        <div class="fashion-scene">

            <!-- Floating label tags -->
            <div class="tag tag-1"><span class="dot-accent">●</span> New Collection</div>
            <div class="tag tag-2"><span class="dot-accent">●</span> In Stock</div>
            <div class="tag tag-3"><span class="dot-accent">●</span> Manage Inventory</div>

            <!-- Ladder with jackets -->
            <div class="ladder">
                <div class="rung"></div>
                <div class="rung"></div>
                <div class="rung"></div>
                <div class="rung"></div>

                <!-- Hanger group at the top -->
                <div class="hanger-group">
                    <div class="jacket jacket-1"></div>
                    <div class="jacket jacket-2"></div>
                </div>

                <!-- Bag at the bottom right -->
                <div class="bag"></div>
            </div>

        </div>
    </div>

    <!-- RIGHT — Sign In Form -->
    <div class="form-panel">
        <div class="form-container">

            <h1 class="form-title">Sign in</h1>
            <p class="form-subtitle">Welcome back. Access your inventory dashboard.</p>

            {{-- Error messages --}}
            @if($errors->any())
                <div class="error-alert">
                    @foreach($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            

            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="field">
                    <label>Email Address</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="your@email.com"
                        class="{{ $errors->has('email') ? 'has-error' : '' }}"
                        required
                        autofocus
                    >
                    @error('email') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <!-- Password -->
                <div class="field">
                    <label>Password</label>
                    <div class="input-wrap">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Enter your password"
                            class="{{ $errors->has('password') ? 'has-error' : '' }}"
                            required
                        >
                        <button type="button" class="eye-btn" onclick="togglePass()">👁</button>
                    </div>
                    @error('password') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <!-- Keep logged in + Forgot password -->
                <div class="options-row">
                    <label class="keep-logged" onclick="toggleCheck(this)">
                        <input type="checkbox" name="remember">
                        <div class="custom-checkbox" id="remember-box"></div>
                        Keep me logged in
                    </label>
                    <a href="#" class="forgot-link">Forgot your password?</a>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-signin">Sign in</button>

                <!-- Sign up link -->
                <p class="footer-link">
                    Don't have an account? <a href="{{ route('register.step1') }}">Sign up</a>
                </p>

            </form>
        </div>
    </div>

</div>

<script>
function toggleDark() {
    const html = document.getElementById('html-root');
    const btn  = document.getElementById('toggle-btn');
    if (html.getAttribute('data-theme') === 'dark') {
        html.removeAttribute('data-theme');
        btn.textContent = '🌙';
    } else {
        html.setAttribute('data-theme', 'dark');
        btn.textContent = '☀️';
    }
}

function togglePass() {
    const input = document.getElementById('password');
    const btn = input.nextElementSibling;
    if (input.type === 'password') {
        input.type = 'text';
        btn.textContent = '🙈';
    } else {
        input.type = 'password';
        btn.textContent = '👁';
    }
}

function toggleCheck(label) {
    const checkbox = label.querySelector('input[type="checkbox"]');
    const box = document.getElementById('remember-box');
    checkbox.checked = !checkbox.checked;
    if (checkbox.checked) {
        box.textContent = '✓';
        box.style.background = '#241f26';
        box.style.borderColor = '#241f26';
        box.style.color = '#fdbf29';
    } else {
        box.textContent = '';
        box.style.background = '';
        box.style.borderColor = '';
        box.style.color = '';
    }
}
</script>

</body>
</html>