
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Laravel App</title>
</head>
<body>
    <header>
        <h1>Header Section</h1>
    </header>

    <div class="content">
        @yield('content')
    </div>

    <footer>
        <p>Footer Section</p>
    </footer>
</body>
</html>



<!-- resources/views/layouts/main.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Laravel App</title>
</head>
<body>
    <header>
        <h1>Header Section</h1>
        @include('partials.navbar') <!-- Menyertakan partial navbar -->
    </header>

    <div class="content">
        @yield('content')
    </div>

    <footer>
        <p>Footer Section</p>
    </footer>
</body>
</html>


