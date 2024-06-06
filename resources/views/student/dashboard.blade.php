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
    <div class="container">
        <h1>Student Dashboard</h1>

        <h2>Your Enrollments</h2>
        @if($enrollments->isEmpty())
            <p>You are not enrolled in any subjects.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Subject Name</th>
                        <th>Slots</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->subject->name }}</td>
                            <td>{{ $enrollment->subject->slots }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <h2>Your Enrollment Cart</h2>
        @if($cart->isEmpty())
            <p>Your enrollment cart is empty.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Subject Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $cartItem)
                        <tr>
                            <td>{{ $cartItem->subject->name }}</td>
                            <td>
                                <form action="{{ route('student.remove-subject', $cartItem->subject_id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="remove-button">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <h2>Search Subjects</h2>
        <form action="{{ route('student.search') }}" method="GET">
            <input type="text" name="query" placeholder="Search for subjects">
            <button type="submit">Search</button>
        </form>

        @isset($subjects)
            <h2>Search Results</h2>
            <table>
                <thead>
                    <tr>
                        <th>Subject Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $subject)
                        <tr>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->description }}</td>
                            <td>
                                <form action="{{ route('student.add-subject') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                                    <button type="submit" class="button">Add to Cart</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endisset

        <form action="{{ route('student.finalize-enrollment') }}" method="POST">
            @csrf
            <button type="submit" class="button">Finalize Enrollment</button>
        </form>
    </div>
</body>
</html>
