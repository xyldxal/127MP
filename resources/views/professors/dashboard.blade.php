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