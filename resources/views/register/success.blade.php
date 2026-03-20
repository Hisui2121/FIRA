<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIRA — Account Created!</title>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700;12..96,800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --yellow: #fdbf29; --yellow-hover: #e6a800; --dark: #241f26;
            --gray: #6b7280; --light-bg: #f7f5f0; --white: #ffffff;
            --border: rgba(36,31,38,0.12); --shadow: 0 4px 32px rgba(36,31,38,0.08);
        }
        body { font-family: 'DM Sans', sans-serif; background: var(--light-bg); color: var(--dark); min-height: 100vh; display: flex; flex-direction: column; }
        nav { display: flex; justify-content: space-between; align-items: center; padding: 18px 52px; background: var(--light-bg); border-bottom: 1px solid var(--border); }
        .logo { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 600; font-size: 1.55rem; color: var(--dark); text-decoration: none; letter-spacing: -0.5px; }
        .logo .dot { color: var(--yellow); }

        .center-wrap {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
        }

        .success-card {
            background: var(--white);
            border-radius: 28px;
            padding: 60px 52px;
            max-width: 600px;
            width: 100%;
            text-align: center;
            box-shadow: var(--shadow);
            animation: fadeUp 0.7s cubic-bezier(0.22,1,0.36,1) forwards;
            opacity: 0;
        }

        .success-icon {
            width: 72px;
            height: 72px;
            background: rgba(253,191,41,0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 28px;
            animation: popIn 0.5s cubic-bezier(0.22,1,0.36,1) 0.3s both;
        }

        .success-title {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 800;
            font-size: 2.2rem;
            color: var(--dark);
            margin-bottom: 14px;
        }

        .success-text {
            font-size: 0.98rem;
            color: var(--gray);
            line-height: 1.7;
            max-width: 400px;
            margin: 0 auto 40px;
        }

        .btn-login {
            background: var(--yellow);
            color: var(--dark);
            border: none;
            padding: 16px 0;
            border-radius: 100px;
            font-family: 'DM Sans', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: block;
            width: 100%;
            transition: all 0.25s ease;
        }

        .btn-login:hover {
            background: var(--yellow-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(253,191,41,0.4);
        }

        .footer-link { margin-top: 24px; font-size: 0.88rem; color: var(--gray); }
        .footer-link a { color: var(--dark); font-weight: 600; text-decoration: none; }

        @keyframes fadeUp { from { opacity: 0; transform: translateY(28px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes popIn { from { transform: scale(0.5); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        @media (max-width: 600px) { nav { padding: 16px 20px; } .success-card { padding: 40px 24px; } }
    </style>
</head>
<body>

<nav>
    <a href="/" class="logo">fira<span class="dot">.</span></a>
</nav>

<div class="center-wrap">
    <div class="success-card">
        <div class="success-icon">✓</div>
        <h1 class="success-title">Account Created!</h1>
        <p class="success-text">
            Welcome to FIRA. Your account has been successfully created.
            You can now log in and start managing your inventory.
        </p>
        <a href="{{ route('login') }}" class="btn-login">Go to Login</a>
        <p class="footer-link">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
    </div>
</div>

</body>
</html>