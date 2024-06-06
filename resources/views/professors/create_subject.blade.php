<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Subject</title>
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
        h1 {
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-top: 10px;
            color: #333;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #006400;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #8B0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create New Subject</h1>
        <form action="{{ route('professor.subjects.store') }}" method="POST">
            @csrf
            <label for="name">Subject Name</label>
            <input type="text" id="name" name="name" required>
            <label for="slots">Available Slots</label>
            <input type="number" id="slots" name="slots" required>
            <button type="submit">Create Subject</button>
        </form>
    </div>
</body>
</html>
