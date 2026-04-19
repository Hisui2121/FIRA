<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{isset($title) ? $title . ' - Fira' : 'Fira'}}</title> 

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/layout.css">
</head>
<body>
    <nav>
        <div class="navbar-start">
            <a href="/" class="brand"> Fira </a>
        </div>
        <div class="nav-actions">
            <span class="text-sm"></span>
            <form action="{{route('logout')}}" method="POST" class = "logout">
                <button type="submit" class="btn">Logout</button>
            </form>
            <a href="/login" class="login-nav">Sign In</a>
            <a href="{{route('register')}}" class="reg-nav">Sign up</a>
        </div>
    </nav>

    <main class="container">
        {{$slot}}
    </main>

    <footer>
        <p>© 2026 Fira - Fashion Inventory Resource Assistant </p>
    </footer>
</body>
</html>