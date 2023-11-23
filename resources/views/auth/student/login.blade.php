<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>student Login and Register</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-box">
        <h2>student Login</h2>
        <form method="POST" action="{{ route('student.login.submit') }}" id="login-form">
            @csrf
            <div class="user-box">
                <input type="text" name="email" required>
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <button class="submit-button" type="submit">Login</button>
            <button class="submit-button" onclick="showRegisterForm()">Register</button>
        </form>
    </div>
    <div class="register-box" style="display:none;">
        <h2>student Register</h2>

        <form method="POST" action="{{ route('register.student') }}" id="register-form">
            @csrf
            <div class="user-box">
                <input type="text" name="name" required>
                <label>Name</label>
            </div>
            <div class="user-box">
                <input type="text" name="email" required>
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <div class="user-box">
                <input type="password" name="confirm_password" required>
                <label>Confirm Password</label>
            </div>
            <button class="submit-button" type="submit">Register</button>
            <button class="submit-button" onclick="showLoginForm()">login</button>

        </form>
    </div>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

</body>
</html>
