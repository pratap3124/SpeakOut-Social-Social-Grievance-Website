<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 2rem;
            background-color: #f2f4f8;
            color: #333;
        }

        h2, h3 {
            color: #0d6efd;
        }

        .griev-form {
            background-color: #ffffff;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 0.75rem;
            margin-top: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }

        button {
            margin-top: 1rem;
            background-color: #0d6efd;
            color: white;
            padding: 10px 16px;
            font-size: 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #084298;
        }

        a {
            text-decoration: underline;
            color:rgb(58, 73, 96);
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .logout-form {
            display: inline;
            background-color: none;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        hr {
            margin: 2rem 0;
        }
    </style>
</head>
<body>
    <div class="header-container">
        <h2>Welcome, {{ Auth::user()->name }}!</h2>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

    <hr>

    <h3> Kindly Submit Your Grievance Here,</h3>
    <form action="{{ route('grievance.submit') }}" method="POST" class="griev-form">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" placeholder="Grievance Title" required><br><br>
        
        <label for="description">Description:</label>
        <textarea name="description" placeholder="Describe your grievance" required></textarea><br><br>
        
        <button type="submit">Submit</button>
    </form>

    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    <a href="{{ route('grievance.responses') }}">See responses to your previous requests →</a>
</body>
</html>
