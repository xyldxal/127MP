<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h1, h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f5f5f5;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #006400;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #8B0000;
        }
    </style>
</head>
<body>
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
