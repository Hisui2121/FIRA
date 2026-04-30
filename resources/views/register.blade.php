<x:layout>
    <x-slot:title>
        Register
    </x-slot:title>

<html>
<body>

<div class="hero">
    <div class="hero-content">
        <div class="card">
            <div class="card-body">
                <h1 class="register">Create Account</h1>

                @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="/register" method="POST">
        @csrf                          
        
        <label>Name:</label><br>
        <input type="text" name="name" value="{{ old('name') }}"><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}"><br><br>

        <label>Password:</label><br>
        <input type="password" name="password"><br><br>

        <label>Confirm Password:</label><br>
        <input type="password" name="password_confirmation"><br><br>

        <button type="submit" class="btn">Register</button>
    </form>

    <p>Already have an account? <a href="/login">Login here</a></p>
            </div>
        </div>
    </div>
</div>


</body>
</html>
</x:layout>