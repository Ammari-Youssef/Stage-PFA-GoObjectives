<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GoObjective</title>

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

    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <a class="navbar-brand px-5" href="#">
            GoObjective
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0 navbar-center">
                <!-- Navigation Links -->
                <li class="nav-item active">
                    <a class="nav-link p-lg-3" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-lg-3" href="#aboutus">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-lg-3" href="#features">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-lg-3" href="#followus">Follow us</a>
                </li>
            </ul>

            <ul class="nav navbar-nav ms-auto navbar-right">
                <li class="nav-item"><a class="p-3" href="#"><i class="fas fa-user"></i> Sign Up</a></li>
                <li class="nav-item"><a class="p-3" href="#"><i class="fas fa-sign-in-alt"></i> Login</a></li>

            </ul>
            <ul class=" navbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-language"></i> </a>
                    <div class="dropdown-menu " aria-labelledby="languageDropdown">
                        <a class="dropdown-item" href="#">English</a>
                        <a class="dropdown-item" href="#">Arabic</a>
                    </div>
                </li>
            </ul>




        </div>
    </nav>


    <section class="landing-section d-flex justify-content-center align-items-center text-center px-5">
        <div class="container">
            <h1 class="display-4">Welcome to GoObjective</h1>
            <p class="lead">Your Success Is Our Aim.</p>
            <p class="lead">Determination is what you need to achieve it .</p>
            <a href="#" class="btn btn-primary btn-lg rounded-pill main-btn mt-2">Get started</a>
        </div>
    </section>

    <section id="aboutus" class="about-section pt-5 pb-5">
        <div class="container">

            <div class="main-title col-md-6 mx-auto mt-5 mb-5">
                <p class="text-center"> <i class="fas fa-book fs-1 mb-3"></i></p>
                <h1 class="text-center fs-1 ">About Us</h1>

            </div>
            <div class="row lh-lg">
                <p class="text-center text-black-50 fs-5">Our aim is to help you achieve success. All we need is your determination to make it happen.</p>
                <p class="text-center text-black-50 fs-5">Ready to crush your daily goals ? GoObjective is here to help you track and monitor your progress in real-time, making success a reality!</p>
            </div>
        </div>
    </section>

    <section id="features" class="features-section ">
        <div class="container">
            <div class="main-title mt-5 mb-5 position-relative">
                <p class="text-center"> <i class="fas fa-palette fs-1 text-center mb-3"></i></p>
                <h2 class="text-center fs-1">Features</h2>

            </div>
            <div class="row">
                <!-- 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feat">
                        <!-- <div class="icon-holder position-relative text-center fs-3">
                            <i class="fas fa-chart-bar  fs-1 text-center mb-3 icon"></i>

                        </div> -->
                        <div class="img">
                            <img src="{{asset('images/charts.jpg') }}" alt="Feature Image" class="img-thumbnail mb-3 float-left">
                        </div>
                        <h4 class="fs-5 my-3 text-uppercase "><b>Mapping Your Success Journey: Comprehensive Goal Tracking Across Multiple Domains</b></h4>
                        <p class=lh-lg>Track your goals, big or small, in nine different domains including spirituality, feelings, health, business, environment, relationships, free time, work, and money. Our easy-to-use goal tracking service keeps you motivated and helps you achieve your dreams through interactive charts that monitor progress and results.</p>
                    </div>
                </div>

                <!-- 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feat">
                        <!-- <div class="icon-holder position-relative text-center fs-3">
                            <i class="fas fa-tasks  fs-1 text-center mb-3 icon"></i>

                        </div> -->
                        <div class="img">
                            <img src="{{asset('images/tasks.jpg') }}" alt="Feature Image" class="img-thumbnail mb-3 float-left">
                        </div>
                        <h4 class="fs-5 my-3 text-uppercase  "><strong>Empower Your Productivity: Streamlined Task Management and Action Planning</strong></h4>
                        <p class=lh-lg>
                            Efficiently manage your tasks, track their completion, and stay organized with our task management tools. Build detailed and organized action plans for reaching your goals with the ability to see all subgoals and corresponding actions on a single page. Utilize recurring tasks for a flexible and precise task schedule that aligns with your goal plan, and easily make changes by dragging and dropping tasks on your calendar.</p>
                    </div>
                </div>

                <!-- 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="feat">
                        <!-- <div class="icon-holder position-relative text-center fs-3">
                            <i class="fas fa-chart-line fs-1 text-center mb-3"></i>

                        </div> -->
                        <div class="img">
                            <img src="{{asset('images/timeline.jpg') }}" alt="Feature Image" class="img-thumbnail mb-3 float-left">
                        </div>
                        <h4 class="fs-5 my-3 text-uppercase "><b>Cultivating Progress: Nurturing Habits for Achieving Your Goals</b></h4>

                        <p class=lh-lg>See Your Improvement Over Time by Monitoring Your Habits' Progress Over the Months. Build Good Habits Linked to Your Goals for Consistent Progress with GoObjective. Customize Habit Duration and Frequency, Check Them off on Habit Tracker Calendars, and Let the Software Automatically Monitor Habit Strength and Execution. </p>
                    </div>
                </div>

            </div>
        </div>
    </section>




    <section>
        <div class="container">
            <div class="main-title mt-5 mb-5">
                <p class="text-center"> <i class="fas fa-question-circle fs-1 text-center mb-3"></i></p>
                <h2 class="text-center fs-1">Why choose us ?</h2>
            </div>
            <div class="row">
                <!-- 1 -->
                <div class="col-md-6  my-3">
                    <div class="reason-why d-flex ">

                        <div class="icon-holder position-relative text-center fs-3">
                            <i class="fas fa-chart-line fs-1 float-left mb-3 icon  p-4 mx-5 rounded-circle bg-light"></i>
                        </div>
                        <div class="content  ">
                            <p class="py-3"><b class="fs-5">Effortlessly track and monitor your progress towards your goals</b></p>
                            <p class="lh-lg">
                                Highlighting the ease of progress Track your goals, big or small, in nine different domains including spirituality, feelings, health, business, environment, relationships, free time, work, and money. Our easy-to-use goal tracking service keeps you motivated and helps you achieve your dreams through interactive charts that monitor progress and results.</p>
                        </div>
                    </div>
                </div>
                <!-- 2 -->
                <div class="col-md-6  my-3">
                    <div class="reason-why d-flex ">

                        <div class="icon-holder position-relative text-center fs-3 ">
                            <i class="fas fa-bell fs-1 float-left mb-3 icon  p-4 mx-5 rounded-circle bg-light"></i>
                        </div>
                        <div class="content  ">
                            <p class="py-3"><b class="fs-5">Receive real-time updates on your success and achievements</b></p>
                            <p class="lh-lg">
                                Real-time updates can be a strong motivator, as users see their progress in real-time. It indicates that your platform keeps them engaged and informed about their accomplishments.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- 3 -->
                <div class="col-md-6  my-3">
                    <div class="reason-why d-flex ">

                        <div class="icon-holder position-relative text-center fs-3 ">
                            <i class="fas fa-thumbs-up fs-1 float-left mb-3 icon  p-4 mx-5 rounded-circle bg-light"></i>
                        </div>
                        <div class="content  ">
                            <p class="py-3"><b class="fs-5">Stay motivated with easy-to-use tracking tools</b></p>
                            <p class="lh-lg">
                                This reason focuses on motivation, which is a critical aspect of goal achievement. Easy-to-use tools contribute to a positive user experience and can encourage consistent engagement.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- 4 -->
                <div class="col-md-6  my-3">
                    <div class="reason-why d-flex ">

                        <div class="icon-holder position-relative text-center fs-3 ">
                            <i class="fas fa-chart-bar fs-1 float-left mb-3 icon  p-4 mx-5 rounded-circle bg-light"></i>
                        </div>
                        <div class="content  ">
                            <p class="py-3">
                                <b class="fs-5 my-3">Get a clear picture of your progress to make necessary adjustments</b>
                            </p>
                            <p class="lh-lg">
                                Clarity in progress tracking empowers users to make informed decisions about their goals. Highlighting the ability to adjust strategies based on data shows your platform's value in aiding successful goal pursuit.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- 5 -->
                <div class="col-md-6  my-3">
                    <div class="reason-why d-flex ">

                        <div class="icon-holder position-relative text-center fs-3 ">
                            <i class="fas fa-smile fs-1 float-left mb-3 icon  p-4 mx-5 rounded-circle bg-light"></i>
                        </div>
                        <div class="content  ">
                            <p class="py-3">
                                <b class="fs-5">Enjoy a user-friendly interface that makes goal tracking a breeze: </b>
                            <p class="lh-lg">
                                Emphasizing a user-friendly interface indicates that your platform is accessible and convenient. It aligns with making the goal tracking process easy and enjoyable.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- 6 -->
                <div class="col-md-6  my-3">
                    <div class="reason-why d-flex ">

                        <div class="icon-holder position-relative text-center fs-3 ">
                            <i class="fas fa-layer-group fs-1 float-left mb-3 icon  p-4 mx-5 rounded-circle bg-light"></i>
                        </div>
                        <div class="content  ">
                            <p class="py-3">
                                <b class="fs-5">Comprehensive Services: </b>
                            <p class="lh-lg">
                                Our services have been meticulously designed to encompass a diverse spectrum of domains, including spirituality, health, business, and more. This approach ensures that we provide a holistic solution catering to various aspects of our customers' lives. By addressing these multidimensional needs, we empower individuals to achieve well-rounded growth and success in every facet of their journey
                            </p>
                        </div>
                    </div>
                </div>





            </div>
        </div>
    </section>




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







    </footer>

</body>

</html>