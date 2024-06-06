
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <!-- Navigation links -->
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>
    <div class="container">
        <h1>Welcome, {{ Auth::user()->name }}</h1>
        <p>This is your dashboard.</p>
        <!-- Add more content relevant to the student dashboard -->
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
