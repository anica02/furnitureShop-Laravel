<!DOCTYPE html>
<html>
@include('fixed.head')

<body>
@include('fixed.header')
@yield('banner')
@yield('content')

@include('fixed.footer')
@include('fixed.scripts')
</body>
</html>
