<header class="@yield('header_class')">
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand2" href="{{route('home-user')}}"><img alt="logo" src="{{asset("assets/img/logo1.png")}}"/></a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav m-auto  mt-lg-0 text-center colorRottenCherry" id="navigation">

                    @if(session()->has('user'))



                                    <li class="nav-item"><a class="nav-link" href="{{route('home-user')}}">Home</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{route('products')}}">Products</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{route('cart')}}">Cart</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{route('orders')}}">Orders</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{route('contact')}}">Contact</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{route('author')}}">Author</a></li>


                            <li class="nav-item"><a class="nav-link" href="{{route('logout')}}">Logout</a></li>
                    @endif
                </ul>
                <h3 class="font-weight-bold font-italic colorRottenCherry">{{session()->get('user')->first_name." " .session()->get('user')->last_name}}</h3>
            </div>

        </nav>

    </div>
 </header>
