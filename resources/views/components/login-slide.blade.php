<div id="pageOverlay"></div>

<div id="loginPanel">
    
    <div class="login-header-icons">
        <button class="close-btn" id="closeLoginBtn">❮</button>
        
        <img src="{{ asset('images/icon_f.png') }}" alt="F Logo" style="width: 25px; filter: brightness(0);">
    </div>

    <h2 class="login-title">System Access</h2>
    <p class="login-subtitle">Authenticate to manage your fashion enterprise inventory.</p>
    
    @if($errors->any())
        <div style="background: #fee2e2; color: #dc2626; padding: 10px; border-radius: 5px; font-size: 0.8rem; margin-bottom: 1rem;">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf
        
        <div class="auth-group">
            <label>Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="admin@fashionenterprise.com">
            <span class="input-icon">✉</span>
        </div>
        
        <div class="auth-group">
            <label>Password</label>
            <input type="password" name="password" required placeholder="••••••••••••">
            <span class="input-icon">👁</span>
        </div>

        <div class="auth-options">
            <label>
                <input type="checkbox" name="remember"> Keep me logged in
            </label>
            <a href="#">Forgot Password?</a>
        </div>

        <button type="submit" class="btn-submit">LOGIN TO DASHBOARD ➔</button>
    </form>

    <div class="login-footer">
        <span>© 2026 Fashion Enterprise Systems.</span>
        <div class="footer-links">
            <a href="{{ route('privacy') }}">Privacy</a>
            <a href="{{ route('security') }}">Security</a>
            <a href="{{ route('contact') }}">Contact</a>
        </div>
    </div>
</div>