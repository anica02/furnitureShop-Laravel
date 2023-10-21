<div class="col-12 col-sm-6  col-lg-4 col-xl-3 product">
    <div class="card mb-5 py-3 px-4 text-center cardWidth">
        <div>
            @if(!empty($discountPrice))
            <div class="text-left pl-2 {{$discountStyle}}">
                <h5 class="py-1 font-italic">{{$discountName}}</h5>
            </div>
           @else
                <div></div>
            @endif

        </div>

        <img src="{{asset('assets/img/'.$imgSrc)}}" class="card-img-top " alt="{{$imgAlt}}">
        <div class="card-body text-left">
            <h4 class="card-title">{{ ucfirst(trans($name))}}</h4>
            <h5 class="card-text">Material:{{$material}}</h5>
            @if(!empty($discountPrice))
            <h5 class="card-text"> {{$discountPrice}}$ &nbsp;<s>{{$price}}$</s></h5>
                @else
                <h5 class="card-text"> {{$price}}$</h5>
            @endif

            <h6 class="card-text">{{$color}} / {{$category}}</h6>


                    @if($status==1)
                        <div class="row text-right">

                            <div class="col-5 col-sm-6 col-xl-5 ">
                                <button type="button" onclick="addToCart({{$prodId}})" class="btn btnProduct colorMint font-weight-bold">
                                    PURCHASE
                                </button>
                            </div>


                        </div>

                        <div class="col-12 mt-3">
                            <p class="card-text inStock text-right"><i class="fas fa-check-circle"></i> In stock</p>
                        </div>
                        <div class="col-12 mt-3">
                            <p class="card-text inStock text-right">Free shipping</p>
                        </div>

                        @elseif($status==0)

                        <div class="col-12 mt-3">
                            <p class="card-text outStock  text-right"><i class="fas fa-times-circle"></i> Out of stock</p>
                        </div>
                    <div class="col-12 mt-3">
                        <p class="card-text inStock text-right">Free shipping</p>
                    </div>
                @endif

        </div>
    </div>
</div>



