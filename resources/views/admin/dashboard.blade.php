<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f9f9f9;
        padding: 40px 60px;
        color: #333;
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        position: relative;
    }

    .header-container h2 {
        font-size: 28px;
        font-weight: 600;
    }

    .logout-btn {
        padding: 8px 16px;
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 500;
    }

    .logout-btn:hover {
        background-color: #c82333;
    }

    .filters-container {
        margin-bottom: 25px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
    }

    .filters-container h3 {
        margin-right: 20px;
        font-size: 20px;
    }

    .btn-filter {
        padding: 8px 16px;
        background-color: #0d6efd;
        color: white;
        border: none;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .btn-filter:hover {
        background-color: #0a58ca;
    }

    .grievance-card {
        border-left: 5px solid #0d6efd;
        padding: 20px;
        margin-bottom: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    .grievance-card h4 {
        font-size: 22px;
        margin-bottom: 10px;
        color: #0d6efd;
    }

    .grievance-card p {
        margin-bottom: 10px;
        font-size: 16px;
    }

    textarea {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        font-size: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
        resize: vertical;
    }

    .submit-btn {
        margin-top: 10px;
        padding: 8px 14px;
        background-color: #198754;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 500;
    }

    .submit-btn:hover {
        background-color: #157347;
    }

    hr {
        margin: 30px 0;
        border: 1px solid #ccc;
    }

    .success-message {
        color: green;
        font-weight: 500;
        margin-bottom: 15px;
    }
</style>

</head>
<body>
    <div class="header-container">
        <h2>Welcome to the Admin Dashboard,</h2>

        <!-- Logout Form -->
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <div class="filters-container">
        <h3>Filter Grievances:</h3>
        <a href="{{ route('admin.dashboard') }}" class="btn-filter">All</a>
        <a href="{{ route('admin.dashboard', ['filter' => 'pending']) }}" class="btn-filter">Pending</a>
        <a href="{{ route('admin.dashboard', ['filter' => 'resolved']) }}" class="btn-filter">Resolved</a>
        <a href="{{ route('admin.dashboard', ['filter' => 'feedback']) }}" class="btn-filter">Feedbacks</a>
    </div>

    <hr>

    @forelse ($grievances as $grievance)
        <div class="grievance-card">
            <h4>{{ $grievance->title }}</h4>
            <p>{{ $grievance->description }}</p>
            <p>Status: <strong>{{ $grievance->status }}</strong></p>

            @if (!$grievance->response)
                <form method="POST" action="{{ route('admin.respond', $grievance->id) }}">
                    @csrf
                    <label for="response">Response:</label><br>
                    <textarea name="response" rows="3" required></textarea><br>
                    <button type="submit" class="submit-btn">Send Response</button>
                </form>
            @else
                <p><strong>Admin Response:</strong> {{ $grievance->response }}</p>
                @if($grievance->feedback)
                    <p><strong>User Feedback:</strong> {{ $grievance->feedback }}</p>
                    <p><strong>Rating:</strong> {{ $grievance->rating }}</p>
                @endif
            @endif
        </div>
    @empty
        <p>No grievances found.</p>
    @endforelse

</body>
</html>
