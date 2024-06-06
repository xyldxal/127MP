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

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h2>Add New Subject</h2>
        <form action="{{ route('professor.subjects.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Subject Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="slots">Slots</label>
                <input type="number" class="form-control" id="slots" name="slots" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Subject</button>
        </form>

        <hr>

        <h2>Your Subjects</h2>
        <ul class="list-group">
            @forelse ($subjects as $subject)
                <li class="list-group-item">
                    {{ $subject->name }}
                    <span class="badge badge-primary badge-pill">{{ $subject->slots }} slots</span>
                    <a href="{{ route('professor.subjects.viewEnrollments', $subject) }}" class="btn btn-info btn-sm float-right">View Enrollments</a>
                </li>
            @empty
                <li class="list-group-item">You have not created any subjects yet.</li>
            @endforelse
        </ul>
    </div>
</body>
</html>
