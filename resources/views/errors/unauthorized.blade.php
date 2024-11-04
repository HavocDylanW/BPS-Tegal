<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container mx-auto mt-10">
        <h1 class="text-3xl font-bold text-red-600">Unauthorized Access</h1>
        <p>You are not authorized to access this page.</p>
        <a href="{{ route('login') }}" class="text-blue-500">Go back to login</a>
    </div>
</body>

</html>
