<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Dashboard</title>
</head>
<body>
    <div class="container">
        <h1>Professor Dashboard</h1>
        <h2>Your Subjects</h2>

        @if($subjects->isEmpty())
            <p>You have not created any subjects.</p>
        @else
            <table border="1">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Slots</th>
                        <th>Enrolled Students</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $subject)
                        <tr>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->slots }}</td>
                            <td>{{ $subject->enrollments_count}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>