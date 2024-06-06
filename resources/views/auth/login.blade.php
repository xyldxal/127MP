<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Ensure your CSS is properly linked -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('{{ asset('images/background.jpg') }}'); /* Ensure this path is correct */
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
            opacity: 0.95;
        }

        h1 {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        button {
            padding: 0.7rem;
            border: none;
            border-radius: 4px;
            background-color: #006400;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 0.5rem;
        }

        button:hover {
            background-color: #8B0000;
        }

        .error {
            color: #b00020;
            font-size: 0.9rem;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="{{ route('login') }}" method="POST" id="loginForm">
            @csrf

            <div>
                <label for="email">Email:</label>
                <input id="email" type="email" name="email" required autofocus>
                <div class="error" id="emailError">Email is required</div>
            </div>

            <div>
                <label for="password">Password:</label>
                <input id="password" type="password" name="password" required>
                <div class="error" id="passwordError">Password is required</div>
            </div>

            <button type="submit">Login</button>
            <!-- Error message from Laravel validation -->
            @if ($errors->has('email'))
                <div class="error">
                    {{ $errors->first('email') }}
                </div>
            @endif
            <p>Don't have an account? <a href="{{ route('register') }}">Sign up here</a></p>
        </form>
    </div>
</body>
</html>
