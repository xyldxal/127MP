<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Dashboard</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/professor-dashboard.css') }}" >
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
</head>
<body>
    <nav>
        <a href="/login">Logout</a>
    </nav>
    <div class="container">
        <h1>Professor Dashboard</h1>
        <a href="{{ route('professor.subjects.create') }}" class="button">Create New Subject</a>
        <h2>Your Subjects</h2>
        @if($subjects->isEmpty())
            <p>You have not created any subjects.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Slots</th>
                        <th>Enrolled Students</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $subject)
                        <tr>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->slots }}</td>
                            <td>{{ $subject->enrollments_count }}</td>
                            <td>
                                <a href="{{ route('professor.subjects.viewEnrollments', $subject) }}">View Enrollments</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
