<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="css/template.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>

<body class="antialiased">
    <div class="relative bg-dots-darker bg-center bg-gray-100 light:bg-dots-lighter light:bg-gray-900 selection:bg-red-500 selection:text-white">

        <nav class="bg-gray-800 p-9">
            <div class="container ms-auto flex justify-between items-center">
                <a href="#" class="text-white text-xl font-bold">GoObjective</a>
                <ul class="flex space-x-4">
                    <li class="py-2"><a href="#" class="text-white hover:text-gray-300">Home</a></li>
                    <li class="py-2"><a href="#" class="text-white hover:text-gray-300">About</a></li>
                    <li class="py-2"><a href="#" class="text-white hover:text-gray-300">Services</a></li>
                    <li class="py-2"><a href="#footer" class="text-white hover:text-gray-300">Contact</a></li>
                </ul>
            </div>
        </nav>

        @yield('content')

        <!-- Footer -->
        <footer class="bg-gray-800 py-6 text-white text-center">
            <nav>
                <ul>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="privacy.php">Privacy Policy</a></li>
                </ul>
            </nav>
            <div class="social-icons">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
            <p>&copy; 2023 GoObjective. All rights reserved.</p>
        </footer>

    </div>
</body>

</html>