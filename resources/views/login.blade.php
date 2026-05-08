<x-layout>

<x-slot:title>
    Login
</x-slot:title>

<div class="login-page">

    <!-- THIS FOR LEFT SIDE -->
    <div class="login-left">

        <!-- PLACEHOLDER -->
        <div class="login-image">
            <img src="/images/login-placeholder.png" alt="Login Image">
        </div>

    </div>

    <!-- THIS FOR RIGHT SIDE -->
    <div class="login-right">

        <div class="login-card">

            <h1>Sign in</h1>
            <p class="subtitle">
                Welcome back. Access your inventory dashboard.
            </p>

            @if(session('success'))
                <p class="success-message">
                    {{ session('success') }}
                </p>
            @endif

            @if($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/login" method="POST">
                @csrf

                <div class="form-group">
                    <label>EMAIL ADDRESS</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                    >
                </div>

                <div class="form-group">
                    <label>PASSWORD</label>
                    <input
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                    >
                </div>

                <div class="form-options">
                    <label class="remember">
                        <input type="checkbox">
                        Keep me logged in
                    </label>

                    <a href="#">Forgot your password?</a>
                </div>

                <button type="submit" class="login-btn">
                    Sign in
                </button>

            </form>

            <p class="register-text">
                Don’t have an account?
                <a href="/register">Sign up</a>
            </p>

        </div>

    </div>

</div>

</x-layout>