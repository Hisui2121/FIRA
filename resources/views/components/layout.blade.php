<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' - Fira' : 'Fira' }}</title> 

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/dashboard.css">
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="brand">fira.</div>

    <div class="nav-right">

        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn">Logout</button>
            </form>
        @else
            <a href="/login" class="btn">Sign In</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Sign Up</a>
        @endauth

        <button class="icon-btn">🌙</button>
        <div class="profile"></div>
    </div>
</div>

<!-- DASHBOARD LAYOUT -->
<div class="dashboard">

    <!-- SIDEBAR -->
    @role('admin')
    <div class="sidebar">
    
        <div class="menu-title">Dashboard</div>

        <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">🏠 Dashboard</a>
        <a href="/products" class="{{ request()->is('products*') ? 'active' : '' }}">📦 Inventory</a>
        <a href="#">👥 Suppliers</a>
        <a href="#">📊 Reports</a>

        <div class="menu-section">Support</div>
        <a href="#">💬 Feedback</a>
        <a href="#">⚙ Settings</a>
        <a href="#">👤 Profile</a>
        
    </div>
    @endrole

    <!-- MAIN CONTENT -->
    <div class="main">
        {{ $slot }}
    </div>

</div>

</body>
</html>