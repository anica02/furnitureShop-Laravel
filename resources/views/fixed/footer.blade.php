<footer>
    <div class="container-fluid">
        <div id="footer">
            <div class="row mb-5 ">
                <div class="col-12 col-sm-6 col-lg-3 mb-2 text-center">
                    <p class="footerCol py-1"><i class="fas fa-phone-alt "></i> Call us: +381 123 4567</p>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 mb-2 text-center">
                    <p class="footerCol py-1"><i class="fas fa-envelope "></i> Email us: dreamy@gmail.com</p>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 mb-2 text-center">
                    <p class="footerCol py-1"><i class="fas fa-map-marker-alt"></i> Visit us at: <a href="https://g.page/golden-tulip-zira-belgrade?share" target="_blank" class="text-decoration-none colorWhite"> Zira, Belgrade</a></p>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 mb-2 text-center">
                    <p class="footerCol py-1"></i> Dream big !</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-3 text-center">
                    <img alt="logo" src="{{asset('assets/img/logo1.png')}}"/>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 text-center colorRottenCherry">
                    <h4 class="font-italic font-weight-bold">About</h4>
                    <h5 class="font-weight-bold">Small business furniture shop</h5>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 text-center colorRottenCherry">
                    <h4 class="font-italic font-weight-bold">Documentation</h4>
                    <a href="{{asset('assets/Dokumentacija.pdf')}}" target="_blank"  class=" colorRottenCherry font18"><i class="fas fa-file-alt"></i></a>
                </div>
                <div class="col-12 col-sm-6 col-lg-3 text-center colorRottenCherry">
                    <h4 class="font-italic font-weight-bold">Find us</h4>
                    <div id="socialN">
                        @foreach($links as $link)
                            <a href="{{$link['href']}}" target="_blank" class="colorRottenCherry fontSI mr-2"><i class="{{$link['icon']}}"></i></a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center colorRottenCherry">
                    <h6 class="font-weight-bold">Copyright &copy; Dreamy| Furniture shop</h6>
                </div>
            </div>


        </div>
    </div>
</footer>


