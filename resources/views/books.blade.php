<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylebooks.css">
    <title>Book List</title>
</head>
<body>
    <h1>Book List</h1>
    <ul>
        @foreach($books as $book)
            <li>{{ $book }}</li>
        @endforeach
    </ul>
<script src="js/scriptbooks.js"></script></script>
</body>
</html>


