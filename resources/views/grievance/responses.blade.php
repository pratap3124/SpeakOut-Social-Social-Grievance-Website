@extends('layouts.app')

@section('content')
<style>
    nav.navbar {
        display: none; /* Hide the main navbar */
    }

    .back-button {
        margin: 1rem 0;
    }

    .back-button a {
        text-decoration: none;
        background-color: #0d6efd;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .back-button a:hover {
        background-color: #084298;
    }

    .grievance-card {
        border-left: 5px solid rgb(126, 141, 164);
        background-color: #f9f9f9;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .grievance-card h2 {
        margin-bottom: 0.5rem;
        color: rgb(12, 49, 119);
        font-weight: bold;
    }

    .grievance-card p {
        margin-bottom: 0.3rem;
    }

    .status {
        font-weight: bold;
        color: #198754;
    }

    .pending-status {
        color: #ffc107;
        font-weight: bold;
    }

    .feedback-form textarea {
        width: 100%;
        padding: 0.5rem;
        border-radius: 6px;
        border: 1px solid #ccc;
        resize: vertical;
    }

    .feedback-form input[type="number"] {
        width: 70px;
        padding: 0.3rem;
        margin-bottom: 1rem;
    }

    .feedback-form button {
        margin-top: 0.5rem;
    }
</style>

<div class="container">
    <div class="back-button">
        <a href="{{ route('dashboard') }}">← Back to Dashboard</a>
    </div>

    <h2 class="mb-4"><center>Your Submitted Grievances</center></h2>

    @if($grievances->isEmpty())
        <p>You have not submitted any grievances yet.</p>
    @else
        @foreach ($grievances as $grievance)
            <div class="grievance-card">
                <h2>{{ $grievance->title }}</h2>
                <p>{{ $grievance->description }}</p>
                <p class="{{ $grievance->status === 'Resolved' ? 'status' : 'pending-status' }}">
                    Status: {{ $grievance->status }}
                </p>

                @if ($grievance->response)
                    <p><strong style="color:rgb(183, 32, 32);">Admin Response:</strong> <span style="color: #495057;">{{ $grievance->response }}</span></p>
                @endif

                @if($grievance->status === 'Resolved' && !$grievance->feedback)
                    <form action="{{ route('grievance.feedback', $grievance->id) }}" method="POST" class="feedback-form">
                        @csrf
                        <label for="rating">Rating (1–5):</label>
                        <input type="number" name="rating" min="1" max="5" required><br>

                        <label for="feedback">Your Feedback:</label>
                        <textarea name="feedback" rows="3" placeholder="Write your feedback here..." required></textarea><br>

                        <button type="submit" class="btn btn-primary">Submit Feedback</button>
                    </form>
                @elseif($grievance->feedback)
                    <p><strong>Your Feedback:</strong> {{ $grievance->feedback }}</p>
                    <p><strong>Rating:</strong> {{ $grievance->rating }}</p>
                @else
                    <p><em>Response pending</em></p>
                @endif
            </div>
        @endforeach
    @endif
</div>
@endsection
