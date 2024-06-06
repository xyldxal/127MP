<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/registration.css') }}" > <!-- Ensure your CSS is properly linked -->

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
