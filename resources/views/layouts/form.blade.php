<!DOCTYPE html>
<html>
@include('fixed.head')

<body>
<div class="container-fluid text-center mt-5">
        <img alt="logo" src="{{asset("assets/img/logo1.png")}}"/>
</div>
@yield('content')
<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 text-center colorRottenCherry">
                <h6 class="font-weight-bold">Copyright &copy; Dreamy| Furniture shop</h6>
            </div>
        </div>
    </div>
</footer>

@include('fixed.scripts')
</body>
</html>
