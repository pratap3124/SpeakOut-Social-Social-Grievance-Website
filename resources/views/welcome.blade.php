<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>
    <div class="container">
        <div class="left-image"></div>
        <div class="right-content">
            <h1>Welcome to Our Grievance Management System</h1>
            <p>"Transparency begins with listening."</p>
            <p>Please log in to continue or register if you're new.</p>
            <div class="buttons">
                <a href="{{ route('login') }}" class="btn">Login</a>
                <a href="{{ route('register') }}" class="btn">Register</a>
            </div>
        </div>
    </div>
</body>
</html>
