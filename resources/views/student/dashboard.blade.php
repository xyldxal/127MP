<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/student-dashboard.css') }}" >
    <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
    <nav>
        <a href="/login">Logout</a>
    </nav>
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
