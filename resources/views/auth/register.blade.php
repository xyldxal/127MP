<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('/images/background.jpg'); /* Update this with your image file name */
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            position: relative;
            opacity: 0.95;
        }

        nav {
            position: fixed;
            right: 1rem;
            top: 1rem;
            z-index: 1000; /* Ensures nav is above all other content */
        }

        nav a {
            text-decoration: none;
            color: white;
            background-color: #006400; /* Dark green background */
            padding: 0.5rem 1rem;
            border-radius: 4px;
            margin-left: 0.5rem;
        }

        nav a:hover {
            background-color: #8B0000; /* Dark red background */
        }

        h1 {
            text-align: center;
            margin-bottom: 1rem;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        input,
        select {
            margin-bottom: 1rem;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        button {
            padding: 0.7rem;
            border: none;
            border-radius: 4px;
            background-color: #006400; /* Dark green background */
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
        }

        button:hover {
            background-color: #8B0000; /* Dark red background */
        }
    </style>
</head>

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
