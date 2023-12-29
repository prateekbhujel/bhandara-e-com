<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title') - {{ config('app.name') }} CMS</title>

    <link rel="stylesheet" href="{{ url('public/css/admin.css') }}">

</head>

<body class="bg-body-secondary">

    @auth
        @include('admin.templates.nav')
    @endauth

    @yield('content')

    <script src="{{ url('public/js/admin.js') }}"></script>

</body>
</html>