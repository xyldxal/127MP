<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/registration.css') }}">
    <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="{{ route('login') }}" method="POST" id="loginForm">
            @csrf

            <div>
                <label for="email">Email*:</label>
                <input id="email" type="email" name="email" placeholder="Email is Required "required autofocus>
                <div class="error" id="emailError"></div>
            </div>

            <div>
                <label for="password">Password*:</label>
                <input id="password" type="password" name="password" placeholder="Password is Required"required>
                <div class="error" id="passwordError"></div>
            </div>

            <p>Fields marked with an asterisk (*) are required.</p>
            <button type="submit">Login</button>

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
