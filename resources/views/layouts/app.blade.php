<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My App</title>
    
    <!-- Menggunakan Bootstrap dari CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Menggunakan Bootstrap Datepicker dari CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- Menggunakan jQuery dari CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Menggunakan Bootstrap JS dari CDN -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- Menggunakan Bootstrap Datepicker JS dari CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</head>
<body>
    <div class="container">
        @yield('content') <!-- Di sinilah section content akan muncul -->
        
        <script type="text/javascript">
            // Pastikan jQuery sudah siap sebelum memanggil datepicker
            $(document).ready(function() {
                $('.date').datepicker({
                    format: 'yyyy/mm/dd',
                    autoclose: true
                });
            });
        </script>
    </div>
</body>
</html>
