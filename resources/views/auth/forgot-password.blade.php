<x-layout>
<x-slot:title>Forgot Password</x-slot:title>

<div class="login-page">
    <div class="login-left">
        <div class="login-image">
            <img src="/images/login-placeholder.png" alt="Reset Password">
        </div>
    </div>

    <div class="login-right">
        <div class="login-card">
            <h1>Reset Password</h1>
            <p class="subtitle">
                Enter your email address and we will send you a link to reset your password.
            </p>

            <form action="/forgot-password" method="POST">
                @csrf
                <div class="form-group">
                    <label>EMAIL ADDRESS</label>
                    <input type="email" name="email" required placeholder="Enter your registered email">
                </div>

                <button type="submit" class="login-btn" style="margin-top: 1rem;">
                    Send Reset Link
                </button>
            </form>

            <p class="register-text" style="margin-top: 2rem;">
                Remembered your password? <a href="/login">Back to Login</a>
            </p>
        </div>
    </div>
</div>
</x-layout>