
<head>
    <title>@yield("title")</title>
    <meta charset="UTF-8"/>
    @yield("csrf-token")
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="keywords" content="@yield("keywords")"/>
    <meta name="description" content="@yield("description")"/>
    <link rel="shortcut icon" href="{{asset("assets/img/logo1.png")}}"/>

    <script src="https://kit.fontawesome.com/ce9a3cdf18.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
    <script src="{{ asset("assets/js/jquery.js") }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/dashboard/">
    <link href="{{asset('assets/css/dashboard.css')}}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{asset("assets/css/style.css")}}"/>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
</head>
