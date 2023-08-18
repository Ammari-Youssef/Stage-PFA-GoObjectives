<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

     <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Styles -->
    <link rel="stylesheet" href="css/template.css">
    <link rel="stylesheet" href="css/welcome.css">
    <!-- <link rel="stylesheet" href="css/navbar.css"> -->

</head>

<body class="antialiased">
    <div class="relative bg-dots-darker bg-center bg-gray-100 light:bg-dots-lighter light:bg-gray-900 selection:bg-red-500 selection:text-white">

      @include('layouts.navbar')

        @yield('content')

        <!-- Footer -->
       <footer id="followus" class="bg-light text-center py-4 lh-lg">
        <div class="container">
            <div class="row">
                <!-- <div class="col-md-6">
                    <h3>Contact Us</h3>
                    <p>Email: contact@example.com</p>
                    <p>Phone: +123456789</p>
                </div> -->
                <div class="col-md-12">
                    <h3>Follow Us</h3>
                    <ul class="d-flex justify-content-center fs- mt-5 list-unstyled gap-5 contacts">

                        <li> <a href="https://facebook.com/goobjective"><i class="fab fa-facebook facebook"></i></a></li>
                        <li> <a href="https://twitter.com/goobjective"><i class="fab fa-twitter twitter  "></i></a></li>
                        <li> <a href="https://instagram.com/goobjective"><i class="fab fa-instagram instagram"></i></a></li>
                        <li> <a href="https://linkedin.com/in/goobjective"><i class="fab fa-linkedin linkedin"></i></a></li>

                    </ul>
                    <p class="text-center">&copy; 2023 GoObjective.com 2023</p>
                    <p class="text-center"> All rights reserved </p>
                </div>
            </div>
        </div>

    </div>
</body>

</html>