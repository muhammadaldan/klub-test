<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klub Sepak Bola</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-500 p-4 text-white">
        <div class="container mx-auto">
            <a href="/" class="text-lg font-bold">Klub Sepak Bola</a>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html>
