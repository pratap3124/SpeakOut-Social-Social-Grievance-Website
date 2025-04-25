<style>
    body {
        font-family: Arial, sans-serif;
        padding: 50px;
        background-color: #f5f5f5;
    }

    .auth-card {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: rgb(255, 255, 255);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .auth-card h2 {
        text-align: center;
        margin-bottom: 1.5rem;
        color: #007bff;
    }

    .auth-card input,
    .auth-card button {
        width: 100%;
        margin-top: 10px;
        padding: 0.6rem;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .auth-card button {
        background-color: #007bff;
        color: white;
        font-weight: bold;
        border: none;
    }

    .auth-card button:hover {
        background-color: #0056b3;
    }

    .alt-link {
        text-align: center;
        margin-top: 1rem;
    }

    .alt-link a {
        color: #007bff;
        text-decoration: none;
    }

    .alt-link a:hover {
        text-decoration: underline;
    }

    .error-messages {
        color: red;
        font-size: 14px;
        margin-top: 10px;
    }
</style>

<div class="auth-card">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h1 style="text-align: center; font-size: 24px; color: #007bff; margin-bottom: 20px;">Login as User</h1>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login as User</button>
    </form>

    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="alt-link">
        <a href="{{ route('admin.login') }}">Login as Admin?</a>
    </div>

    <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
</div>
