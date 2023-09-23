<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a><br/> <h1 align="center">GoObjectives</h1></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# GoObjectives

GoObjectives is a web application built with Laravel, Ajax, and Bootstrap, and it represents the culmination of my internship. This project is designed to help users boost their productivity by setting and tracking their goals effectively.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Features

-   **User Authentication**: Secure user registration and login functionality.
-   **Goal Management**: Create, update, and delete goals.
-   **Task Tracking**: Track tasks related to each goal.
-   **Productivity Dashboard**: Visualize your progress with interactive charts.
-   **Ajax Integration**: Seamlessly update content without page reloads.
-   **Responsive Design**: Ensure a consistent user experience on all devices.

## Technologies & Tools

### Client-side

-   **Blade**: A templating engine for Laravel.
-   **Bootstrap**: A popular CSS framework for building responsive and visually appealing web interfaces.
-   **Chart.js**: A JavaScript library for creating interactive and visually appealing charts.

### Server-side

-   **PHP**: The server-side scripting language used in Laravel.
-   **Ajax**: Asynchronous JavaScript and XML, used for seamless data exchange with the server.
-   **jQuery**: A JavaScript library that simplifies HTML document traversal and manipulation.

### Database

-   **MySQL**: A powerful and widely-used relational database management system.

### Merise MCD : 
![](MCD.png)

## Installation

Follow these steps to set up GoObjective locally on your machine:

### Prerequisites

Before you begin, ensure you have met the following requirements:

-   [Composer](https://getcomposer.org/): PHP package manager.
-   [Node.js](https://nodejs.org/): JavaScript runtime.
-   [npm](https://www.npmjs.com/): Node package manager.
-   [MySQL](https://www.mysql.com/): A relational database management system.

### Clone the Repository

1. Clone the GoObjective repository to your local machine:

    ```bash
    git clone
    ```

    ```bash
    cd goobjectives
    ```

2. Install Dependencies

-   Install PHP dependencies using Composer:

    ```bash
    composer install
    ```

-   Install JavaScript dependencies using npm:

    ```bash
    npm install
    ```

3.  Configuration

-   Create a copy of the .env.example file and save it as .env:
-   Generate an application key using command :

    ```
    php artisan key:generate
    ```
- Configure your .env file with your database connection details and any other necessary settings.
4. Database Migration

    ```
    php artisan migrate
    ```
5. Start the Development Server

- Start the Laravel development server:

    ```
    php artisan serve
    ```


- Access the application in your web browser at http://localhost:8000.    

6. Enjoy ^^

## Screenshots

Here are some screenshots of GoObjective to give you a glimpse of the application:

**Dashboard:**

![Dashboard](/path/to/screenshot1.png)
*Description of the dashboard screen.*

**Goal Management:**

![Goal Management](/path/to/screenshot2.png)
*Description of the goal management screen.*

**Task Tracking:**

![Task Tracking](/path/to/screenshot3.png)
*Description of the task tracking screen.*

**Productivity Dashboard:**

![Productivity Dashboard](/path/to/screenshot4.png)
*Description of the productivity dashboard screen.*