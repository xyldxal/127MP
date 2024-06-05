<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
</head>
<body>
    <h1>Student Registration</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="email">Email:</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        <br>
        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="student">Student</option>
            <option value="professor">Professor</option>
        </select>
        <br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
