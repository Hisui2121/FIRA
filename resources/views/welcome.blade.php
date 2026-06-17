<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIRA - Manage Less, Grow More</title>
    <style>
        /* Base Styles */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #ffffff; color: #1a1a1a; overflow-x: hidden; }

        /* Navigation (Logo) */
        nav { padding: 2rem 5%; font-size: 1.5rem; font-weight: 900; letter-spacing: -1px; }
        nav span { color: #EAB308; }

        /* Hero Section */
        .hero {
            background-color: #FBBF24; margin: 0 5%; border-radius: 20px;
            display: flex; position: relative; min-height: 500px; overflow: visible;
        }
        .hero-content { padding: 5rem 3rem; width: 50%; z-index: 2; }
        .hero h1 { font-size: 3.5rem; font-weight: 900; line-height: 1.1; margin-bottom: 1.5rem; color: #1f2937; }
        .hero p { font-size: 1.1rem; margin-bottom: 2rem; color: #4b5563; max-width: 400px; }
        .btn-primary { background-color: #1a1a1a; color: white; padding: 12px 35px; border: none; border-radius: 30px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: 0.3s; }
        .btn-primary:hover { background-color: #333; }
        .hero-img { position: absolute; right: 0; top: 0; height: 140%; z-index: 10; }

       /* Banner Section */
        .banner {
            background-color: #2563EB; background-image: url("{{ asset('images/banner_tagline.png') }}");
            background-size: cover; background-position: center; background-blend-mode: normal;
            margin: 50px 5% 4rem; border-radius: 15px; padding: 2rem 3rem;
            display: flex; align-items: center; gap: 2rem; color: white; position: relative; overflow: hidden;
        }
        .banner img { width: 40px; }
        .banner p { font-size: 1.1rem; font-weight: 500; max-width: 500px; }

        /* Categories Section */
        .categories-container { padding: 0 5% 5rem; }
        .categories-title { text-align: center; color: #064E3B; font-size: 2rem; margin-bottom: 3rem; font-weight: 800; }
        .grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .category-card { position: relative; border-radius: 10px; overflow: hidden; aspect-ratio: 1; cursor: pointer; transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .category-card img { width: 100%; height: 100%; object-fit: cover; }
        .category-card:hover { transform: scale(1.05); box-shadow: 0 10px 20px rgba(0,0,0,0.15); z-index: 2; }
        .category-label { position: absolute; top: 15px; left: 15px; color: #1a1a1a; font-weight: 600; font-size: 0.9rem; letter-spacing: 1px; }

        /* =========================================
           LOGIN COMPONENT STYLES (NEW DESIGN)
           ========================================= */
        
        /* Dark Overlay */
        #pageOverlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100vh;
            background: rgba(0,0,0,0.6); z-index: 90;
            opacity: 0; visibility: hidden; transition: 0.4s ease;
        }
        #pageOverlay.active { opacity: 1; visibility: visible; }

        /* Panel Box */
        #loginPanel {
            position: fixed; top: 0; right: -500px; width: 100%; max-width: 450px; height: 100vh;
            background-color: white; box-shadow: -10px 0 30px rgba(0,0,0,0.3);
            z-index: 100; transition: right 0.4s ease-in-out;
            padding: 3rem 2.5rem; display: flex; flex-direction: column;
        }
        #loginPanel.active { right: 0; }

        /* Panel Elements */
        .login-header-icons { display: flex; justify-content: space-between; align-items: center; margin-bottom: 4rem; }
        .close-btn { font-size: 1.2rem; cursor: pointer; border: none; background: none; font-weight: bold; }
        .logo-dark { font-weight: 900; font-size: 1.5rem; font-style: italic; }
        
        .login-title { font-size: 1.8rem; font-weight: 800; margin-bottom: 0.5rem; color: #111;}
        .login-subtitle { color: #666; font-size: 0.85rem; margin-bottom: 2rem; }
        
        .auth-group { margin-bottom: 1.5rem; position: relative; }
        .auth-group label { display: block; font-size: 0.65rem; font-weight: 800; color: #888; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .auth-group input { width: 100%; padding: 10px 0; border: none; border-bottom: 1px solid #ddd; font-size: 0.9rem; outline: none; transition: 0.3s; color: #333;}
        .auth-group input:focus { border-bottom-color: #000; }
        .input-icon { position: absolute; right: 0; top: 25px; color: #ccc; font-size: 1.1rem; }
        
        .auth-options { display: flex; justify-content: space-between; align-items: center; font-size: 0.75rem; margin: 1.5rem 0 2rem; color: #666; }
        .auth-options label { display: flex; align-items: center; gap: 8px; cursor: pointer; }
        .auth-options a { color: #666; text-decoration: none; font-weight: 600; }
        .auth-options a:hover { text-decoration: underline; color: #000; }
        
        .btn-submit { width: 100%; background: black; color: white; padding: 16px; border: none; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px; cursor: pointer; display: flex; justify-content: center; align-items: center; transition: 0.3s; }
        .btn-submit:hover { background: #333;}
        
        .login-footer { margin-top: auto; border-top: 1px solid #eee; padding-top: 1.5rem; display: flex; justify-content: space-between; font-size: 0.65rem; color: #999; font-weight: 600; }
        .footer-links { display: flex; gap: 15px; }
        .footer-links a { color: #999; text-decoration: none; }

        /* Responsive Design */
        @media (max-width: 900px) {
            .hero { flex-direction: column; text-align: center; overflow: hidden; min-height: auto; }
            .hero-content { width: 100%; padding: 3rem 1.5rem; }
            .hero-img { position: relative; bottom: 0; height: 300px; margin-top: -20px; z-index: 1; }
            .grid { grid-template-columns: repeat(2, 1fr); }
            .banner { margin-top: 2rem; }
        }
        @media (max-width: 600px) { .grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

    <nav>fira<span>.</span></nav>

    <section class="hero">
        <div class="hero-content">
            <h1>MANAGE LESS,<br>GROW MORE WITH FIRA<span>.</span></h1>
            <p>All-in-one platform to track your products, manage suppliers, and monitor daily sales in real-time</p>
            <button class="btn-primary" id="openLoginBtn">Log In</button>
        </div>
        <img src="{{ asset('images/hero_guy.png') }}" alt="Fashion Model" class="hero-img">
    </section>

    <section class="banner">
        <img src="{{ asset('images/icon_f.png') }}" alt="F Logo">
        <p>Elevating standards for our products, our people, and our customers.</p>
    </section>

    <section class="categories-container">
        <h2 class="categories-title">OUR CLOTHING CATEGORIES</h2>
        <div class="grid">
            <div class="category-card"><span class="category-label">WOMEN</span><img src="{{ asset('images/category_female.png') }}" alt="Women"></div>
            <div class="category-card"><span class="category-label">MEN</span><img src="{{ asset('images/category_male.png') }}" alt="Men"></div>
            <div class="category-card"><span class="category-label">KIDS</span><img src="{{ asset('images/category_kids.png') }}" alt="Kids"></div>
            <div class="category-card"><span class="category-label">BEAUTY</span><img src="{{ asset('images/category_beauty.png') }}" alt="Beauty"></div>
            <div class="category-card"><span class="category-label">SPORTS</span><img src="{{ asset('images/category_sports.png') }}" alt="Sports"></div>
            <div class="category-card"><span class="category-label">LUXURY</span><img src="{{ asset('images/category_luxury.png') }}" alt="Luxury"></div>
        </div>
    </section>

    <x-login-slide />

    <script>
        const openBtn = document.getElementById('openLoginBtn');
        const closeBtn = document.getElementById('closeLoginBtn');
        const loginPanel = document.getElementById('loginPanel');
        const overlay = document.getElementById('pageOverlay');

        function openPanel() {
            loginPanel.classList.add('active');
            overlay.classList.add('active'); 
        }

        function closePanel() {
            loginPanel.classList.remove('active');
            overlay.classList.remove('active'); 
        }

        openBtn.addEventListener('click', openPanel);
        closeBtn.addEventListener('click', closePanel);
        overlay.addEventListener('click', closePanel); 

        // AUTO-OPEN KAPAG MAY ERROR
        // Kapag may na-detect na error si Laravel, i-o-open agad ang panel
        @if($errors->any())
            openPanel();
        @endif
    </script>

</body>
</html>