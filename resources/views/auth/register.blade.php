<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPM Registration</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/registration.css') }}" >

<body>
    <nav>
        <a href="/">Home</a>
        <a href="/login">Login</a>
    </nav>
    <div class="container">
        <h1>UPM Registration</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email:</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="student">Student</option>
                <option value="professor">Professor</option>
            </select>
            <button type="submit">Register</button>
        </form>
    </div>
</body>

</html>
