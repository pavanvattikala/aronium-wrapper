<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/chart.js') }}"></script>

    <style>
        footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: blue;
            color: white;
            text-align: center;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-900">
    <header class="bg-blue-500 text-white py-4">
        <div class="container mx-auto px-4">
            <a href="/">
                <h1 class="text-2xl font-bold">Aronium Wrapper</h1>
            </a>
        </div>
    </header>

    <main class="container mx-auto my-8 px-4">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-4">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Pavan Vattikala. All rights reserved.</p>
        </div>
    </footer>


</body>

</html>
