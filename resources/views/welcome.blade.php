<!DOCTYPE html>
<html lang="en" id="html-root">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIRA — Efficient Inventory for the Fashion Industry</title>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,700;12..96,800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --yellow: #fdbf29;
            --yellow-hover: #e6a800;
            --dark: #241f26;
            --gray: #6b7280;
            --light-bg: #f7f5f0;
            --white: #ffffff;
            --border: rgba(36,31,38,0.1);
            --card-shadow: 0 12px 40px rgba(36,31,38,0.15);
        }

        [data-theme="dark"] {
            --dark: #f0ece8;
            --gray: #9ca3af;
            --light-bg: #1a1718;
            --white: #241f26;
            --border: rgba(255,255,255,0.1);
            --card-shadow: 0 12px 40px rgba(0,0,0,0.5);
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--light-bg);
            color: var(--dark);
            min-height: 100vh;
            overflow-x: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* ── NAVBAR ── */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 52px;
            background: var(--light-bg);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid var(--border);
            transition: background-color 0.3s ease, border-color 0.3s ease;
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

        .dark-toggle:hover {
            background: var(--dark);
            color: var(--light-bg);
            border-color: var(--dark);
        }

        /* ── HERO ── */
        .hero {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 72px 48px 90px;
            max-width: 980px;
            margin: 0 auto;
        }

        .hero h1 {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 800;
            font-size: clamp(2.5rem, 5.5vw, 3.9rem);
            line-height: 1.13;
            color: var(--dark);
            animation: fadeUp 0.75s cubic-bezier(0.22,1,0.36,1) forwards;
            opacity: 0;
            transition: color 0.3s ease;
        }

        .hero h1 .accent { color: var(--yellow); }

        /* ── CARDS STACK ── */
        .cards-wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            margin: 48px 0 44px;
            animation: fadeUp 0.75s cubic-bezier(0.22,1,0.36,1) 0.12s forwards;
            opacity: 0;
        }

        .cards-stack {
            position: relative;
            width: 780px;
            height: 275px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            position: absolute;
            width: 192px;
            height: 242px;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
            transition: transform 0.45s cubic-bezier(0.22,1,0.36,1), box-shadow 0.3s ease;
            cursor: pointer;
        }

        .card-inner {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
        }

        /* Fan layout matching PDF exactly */
        .card:nth-child(1) {
            transform: rotate(-11deg) translateX(-265px) translateY(12px);
            background: linear-gradient(145deg, #7ec8e3, #4a9eba);
            z-index: 1;
        }
        .card:nth-child(2) {
            transform: rotate(-5.5deg) translateX(-128px) translateY(5px);
            background: linear-gradient(145deg, #e8d5c4, #cba882);
            z-index: 2;
        }
        .card:nth-child(3) {
            transform: rotate(0deg) translateX(8px) translateY(0px);
            background: linear-gradient(145deg, #b8a9d9, #8b74c4);
            z-index: 5;
        }
        .card:nth-child(4) {
            transform: rotate(5.5deg) translateX(148px) translateY(5px);
            background: linear-gradient(145deg, #e8a8b0, #c4707c);
            z-index: 2;
        }
        .card:nth-child(5) {
            transform: rotate(11deg) translateX(280px) translateY(12px);
            background: linear-gradient(145deg, #fdbf29, #e6a000);
            z-index: 1;
        }

        .cards-stack:hover .card:nth-child(1) {
            transform: rotate(-13deg) translateX(-272px) translateY(4px);
            box-shadow: 0 20px 50px rgba(36,31,38,0.2);
        }
        .cards-stack:hover .card:nth-child(2) {
            transform: rotate(-6.5deg) translateX(-133px) translateY(-5px);
            box-shadow: 0 20px 50px rgba(36,31,38,0.2);
        }
        .cards-stack:hover .card:nth-child(3) {
            transform: rotate(0deg) translateX(8px) translateY(-10px);
            box-shadow: 0 24px 56px rgba(36,31,38,0.25);
        }
        .cards-stack:hover .card:nth-child(4) {
            transform: rotate(6.5deg) translateX(153px) translateY(-5px);
            box-shadow: 0 20px 50px rgba(36,31,38,0.2);
        }
        .cards-stack:hover .card:nth-child(5) {
            transform: rotate(13deg) translateX(288px) translateY(4px);
            box-shadow: 0 20px 50px rgba(36,31,38,0.2);
        }

        /* ── SUBTITLE ── */
        .subtitle {
            font-size: 1.02rem;
            color: var(--gray);
            line-height: 1.75;
            max-width: 490px;
            margin-bottom: 44px;
            animation: fadeUp 0.75s cubic-bezier(0.22,1,0.36,1) 0.22s forwards;
            opacity: 0;
            transition: color 0.3s ease;
        }

        /* ── BUTTONS ── */
        .btn-group {
            display: flex;
            gap: 14px;
            align-items: center;
            animation: fadeUp 0.75s cubic-bezier(0.22,1,0.36,1) 0.32s forwards;
            opacity: 0;
        }

        .btn-primary {
            background: var(--yellow);
            color: var(--dark);
            border: none;
            padding: 15px 30px;
            border-radius: 100px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.25s ease;
        }

        .btn-primary:hover {
            background: var(--yellow-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(253,191,41,0.45);
        }

        .btn-secondary {
            background: transparent;
            color: var(--dark);
            border: 1.5px solid var(--dark);
            padding: 14px 30px;
            border-radius: 100px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.25s ease;
        }

        .btn-secondary:hover {
            background: var(--dark);
            color: var(--light-bg);
            transform: translateY(-2px);
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 820px) {
            nav { padding: 16px 24px; }
            .hero { padding: 48px 24px 60px; }

            .cards-stack { width: 360px; height: 210px; }
            .card { width: 135px; height: 170px; border-radius: 16px; }
            .card-inner { font-size: 2.2rem; }
            .card:nth-child(1) { transform: rotate(-11deg) translateX(-148px) translateY(8px); }
            .card:nth-child(2) { transform: rotate(-5.5deg) translateX(-70px) translateY(4px); }
            .card:nth-child(3) { transform: rotate(0deg) translateX(5px) translateY(0); }
            .card:nth-child(4) { transform: rotate(5.5deg) translateX(82px) translateY(4px); }
            .card:nth-child(5) { transform: rotate(11deg) translateX(157px) translateY(8px); }

            .btn-group { flex-direction: column; width: 100%; max-width: 320px; }
            .btn-primary, .btn-secondary { width: 100%; justify-content: center; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav>
        <a href="/" class="logo">fira<span class="dot">.</span></a>
        <button class="dark-toggle" id="toggle-btn" onclick="toggleDark()" title="Toggle dark mode">🌙</button>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero">

        <!-- Heading -->
        <h1>
            Efficient inventory for the<br>
            <span class="accent">fashion</span> industry
        </h1>

        <!-- Image Cards Fan Stack -->
        <div class="cards-wrapper">
            <div class="cards-stack">
                <div class="card"><div class="card-inner">👗</div></div>
                <div class="card"><div class="card-inner">👜</div></div>
                <div class="card"><div class="card-inner">👠</div></div>
                <div class="card"><div class="card-inner">🧥</div></div>
                <div class="card"><div class="card-inner">✨</div></div>
            </div>
        </div>

        <!-- Subtitle -->
        <p class="subtitle">
            To provide an organized platform for managing fashion products,
            suppliers, and stock through simple and reliable technology.
        </p>

        <!-- CTA Buttons -->
        <div class="btn-group">
            <a href="/register" class="btn-primary">Create an Account &nbsp;→</a>
            <a href="/login"    class="btn-secondary">Sign in</a>
        </div>

    </section>

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
    </script>

</body>
</html>