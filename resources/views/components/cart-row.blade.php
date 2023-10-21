


<div class="row" class="cartItems" id="cartItem_{{$idProd}}">
    <div class="col-12 col-sm-3  text-center">
        <img src="{{asset('assets/img/'.$image)}}" class="w-100" alt="{{$alt}}">
    </div>
    <div class="col-12 col-sm-3 text-center rowItem font-weight-bold colorRottenCherry">
        <div class="col text-center font-weight-bold colorMint font18">
            <p>Name</p>
        </div>
        <p>{{$name}}</p>
    </div>
    <div class="col-12 col-sm-2  text-center rowItem  font-weight-bold colorRottenCherry">
        <div class="col text-center font-weight-bold colorMint font18">
            <p>Quantity</p>
        </div>
        @if($discount)
        <input type="number" onchange="changeQuantity(
        {{$idProd}},{{$discount}},{{count(session()->get('cart'))}},this
        )" value="{{ session()->get("cart")[$idProd] }}" style="width: 6em" />
        @else
        <input type="number" onchange="changeQuantity(
        {{$idProd}}, {{$price}},{{count(session()->get('cart'))}},this
        )" value="{{ session()->get("cart")[$idProd] }}" style="width: 6em" />
        @endif

    </div>

     <div class="col-12 col-sm-2  text-center rowItem  font-weight-bold colorRottenCherry">
         <div class="col text-center font-weight-bold colorMint font18">
             <p>Price</p>
         </div>
         @if($discount)
             <p id="price_{{$idProd}}">{{ number_format((float)$discount * session()->get("cart")[$idProd], 2, '.', ''). " $" }}</p>

         @else
                <p id="price_{{$idProd}}">{{   number_format((float)$price * session()->get("cart")[$idProd], 2, '.', ''). " $" }}</p>
             @endif


    </div>
    <div class="col-12 col-sm-2  text-center rowItem ">
        <div class="col text-center font-weight-bold ">
            <p></p>
        </div>
        <button onclick="removeFromCart({{$idProd}})" class="colorMint btn removeButton py-1 px-1">Remove</button>
    </div>

</div>
