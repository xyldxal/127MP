<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Subject</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/professor-dashboard-create.css') }}" >
</head>
<body>
    <div class="container">
        <h1>Create New Subject</h1>
        <form action="{{ route('professor.subjects.store') }}" method="POST">
            @csrf
            <label for="name">Subject Name</label>
            <input type="text" id="name" name="name" placeholder="Enter Subject Name Here" required>
            <label for="slots">Available Slots</label>
            <input type="number" id="slots" name="slots" placeholder="Enter Slots Here" required>
            <button type="submit">Create Subject</button>
        </form>
    </div>
</body>
</html>
