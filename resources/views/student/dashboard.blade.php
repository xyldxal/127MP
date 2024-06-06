<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('/images/dashboard-background.jpg');
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        nav {
            position: absolute;
            top: 0;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 0.5rem 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
        }

        nav a {
            color: #006400;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            color: #8B0000;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 80%;
            max-width: 600px;
        }

        h1 {
            color: #006400;
        }

        p {
            color: #555;
            font-size: 16px;
        }

        form {
            margin: 20px 0;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #006400;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #8B0000;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        li form {
            display: inline;
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('student.dashboard') }}">Dashboard</a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>
    <div class="container">
        <h1>Welcome, {{ Auth::user()->name }}</h1>
        <p>This is your dashboard.</p>
        
        <!-- Search for subjects -->
        <form action="{{ route('student.search') }}" method="POST">
            @csrf
            <input type="text" name="query" placeholder="Search for subjects">
            <button type="submit">Search</button>
        </form>

        <!-- Display search results -->
        @if(isset($subjects) && $subjects->count() > 0)
            <h2>Search Results</h2>
            <ul>
                @foreach ($subjects as $subject)
                    <li>
                        {{ $subject->name }}
                        <form action="{{ route('student.add-subject') }}" method="POST">
                            @csrf
                            <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                            <button type="submit">Add</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @elseif(isset($query))
            <p>No subjects found for "{{ $query }}".</p>
        @endif

        <!-- Display enrolled subjects -->
        <h2>Enrolled Subjects</h2>
        <ul>
            @if(Auth::user()->enrollments && Auth::user()->enrollments->count() > 0)
                @foreach (Auth::user()->enrollments as $enrollment)
                    <li>
                        {{ $enrollment->subject->name }}
                        <form action="{{ route('student.remove-subject', $enrollment->subject_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Remove</button>
                        </form>
                    </li>
                @endforeach
            @else
                <p>You are not enrolled in any subjects.</p>
            @endif
        </ul>

        <!-- Finalize enrollment -->
        <form action="{{ route('student.finalize-enrollment') }}" method="POST">
            @csrf
            <button type="submit">Finalize Enrollment</button>
        </form>
    </div>
</body>
</html>
