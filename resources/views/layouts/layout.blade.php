<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('fragments.css-header')
</head>

<body>
    @include('fragments.menu')
    <div class="main container p-2">
        @yield('content')
    </div>
    <div class="footer">
        <span>Copy right @Codegym Huế</span>
    </div>
    @include('fragments.js-footer')

    @stack('my-scripts')


</body>

</html>