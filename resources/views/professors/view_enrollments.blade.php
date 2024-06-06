<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollments for {{ $subject->name }}</title>
</head>
<body>
    <div class="container">
        <h1>Enrollments for {{ $subject->name }}</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h3>Enrolled Students</h3>
        <ul class="list-group mb-3">
            @foreach ($enrollments as $enrollment)
                <li class="list-group-item">
                    {{ $enrollment->student->name }} - {{ $enrollment->student->email }}
                    <form action="{{ route('professor.subjects.removeStudent', $enrollment) }}" method="POST" class="float-right">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Remove Student</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <a href="{{ route('professor.dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
    </div>
</body>
</html>