<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teacher Login and Register</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-box">
        <h2>Teacher Login</h2>
        <form method="POST" action="{{ route('teacher.login') }}" id="login-form">
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
        <h2>Teacher Register</h2>

        <form method="POST" action="{{ route('register.teacher') }}" id="register-form" >
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
    <script>
        function showRegisterForm() {
            const loginBox = document.querySelector('.login-box');
            const registerBox = document.querySelector('.register-box');
            loginBox.style.display = 'none';
            registerBox.style.display = 'block';
        }
        function showLoginForm() {
            const loginBox = document.querySelector('.login-box');
            const registerBox = document.querySelector('.register-box');
            loginBox.style.display = 'block';
            registerBox.style.display = 'none';
        }
    </script>
</body>
</html>