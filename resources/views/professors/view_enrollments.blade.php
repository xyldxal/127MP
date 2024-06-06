<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Enrollments</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/professor-dashboard.css') }}" >
</head>
<body>
    <div class="container">
        <h1>Enrollments for {{ $subject->name }}</h1>
        @if($enrollments->isEmpty())
            <p>No students are currently enrolled in this subject.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->student->name }}</td>
                            <td>{{ $enrollment->student->email }}</td>
                            <td>
                                <form action="{{ route('professor.subjects.removeStudent', $enrollment) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="remove-button">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
