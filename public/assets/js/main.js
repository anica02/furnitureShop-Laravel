
$(document).ready(function(){

    $('#filterP ul > li ul')
    .click(function(e){
      e.stopPropagation();
    })
    .filter(':not(:first)')
    .hide();

  $('#filterP ul > li').click(function(){
    var selfClick = $(this).find('ul:first').is(':visible');
    if(!selfClick) {
      $(this)
        .parent()
        .find('> li ul:visible')
        .slideToggle();
    }

    $(this)
      .find('ul:first')
      .stop(true, true)
      .slideToggle();
  });

    $('.paginationP').click(function(e){
        e.preventDefault();
        let limit = $(this).data('limit');
        let token = $(this).data('token');
        let url= $(this).data('url');
        let parent=$(this).parent().parent();

        if(url==="order-pag"){
            $("#paginationO").children(".active").removeClass('active');
        }

        $("li.active").removeClass('active');
        $(this).parent().addClass('active');

        $.ajax({
            url: url,
            method: 'post',
            data: {
                limit:limit,
                _token: token
            },
            success: function(result){

                if(url==="order-pag"){
                    displayOrder(result);
                }
            },
            error: function(xhr) {
                console.log(xhr)
            }
        });
    });
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const displayOrderItemsAdmin = (data) => {

    const products=data['products'];
    document.getElementById('orderItems').innerHTML = data['data'].map(el => {

        if (data['data']) {
            for(const prod of products){
                if(prod.id == el.id_product){
                    return `
                    <tr id="orderItemId_${el.id}">
                    <td class="col-3 text-center"><img src="assets/img/${prod.img_src}" class="imgWidth" alt="${prod.img_alt}"/></td>
                    <td class="col-2 text-center" >${prod.name}</td>
                    <td class="col-2 text-center">${el.quantity}</td>
                    <td class="col-3 text-center">${el.price} $</td>

                    </tr>`
                        ;
                }
            }
        } else {
            return `<div class="col-12">
            <p class="alert-danger my-5 text-center py-2 font-weight-bold">No orders</p>
        </div>`;
        }

    }).join('');

}

const displayOrderItems = (data) => {

    const products=data['products'];
    document.getElementById('orderItems').innerHTML = data['data'].map(el => {

        if (data['data']) {
            for(const prod of products){
                if(prod.id == el.id_product){
                    return `
                    <tr id="orderItemId_${el.id}">
                    <td class="col-3 text-center"><img src="assets/img/${prod.img_src}" class="imgWidth" alt="${prod.img_alt}"/></td>
                    <td class="col-2 text-center" >${prod.name}</td>
                    <td class="col-2 text-center">${el.quantity}</td>
                    <td class="col-3 text-center">${el.price} $</td>
                    </tr>`
                        ;
                }
            }
        } else {
            return `<div class="col-12">
            <p class="alert-danger my-5 text-center py-2 font-weight-bold">No orders</p>
        </div>`;
        }

    }).join('');

}

const displayUserParam= (data)=>{
    const roles=data['roles'];
   document.getElementById('user').innerHTML=data['data'].map(el=>{
       let html="";

            html=`<div class='col-12'>

                <p class="font-weight-bold colorRottenCherry font18">User: ${el.email}</p>

            </div>
            <div class='col-12'>
                <label class="font-weight-bold colorRottenCherry font18">Account status</label>
                <select name="status" class="form-control">`;


            if(el.active===0){
              html+=`<option value="0" selected>Inactive</option>
                        <option value="1" >Active</option>`;
            }

            else if(el.active===1){
                html+=`<option value="0" >Inactive</option>
                        <option value="1" selected>Active</option>`;
            }
                html+=`</select>
            </div>
             <div class='col-12'>
                <label class="font-weight-bold colorRottenCherry font18">Role</label>
                <select name="role" class="form-control">`;

               for(const r of roles){

                    if(el.id_role===r.id){
                        html+=`<option value="${r.id}" selected >${r.role}</option>`;
                    }
                    else {
                        html += `<option value="${r.id}" >${r.role}</option>`;
                    }
               }

              html+=`</select>
            </div>
            <div class="col-12 mt-2">
                <input type="hidden" value="${el.id}" name="userId">
                <button type="submit" name="btnUser" class="btn btnSubmit colorMint font-weight-bold font18"> Edit</button>
            </div>`;
       return html;
   }).join('');
}


function addToCart(id) {

    $.ajax({
        url : "add-to-cart",
        beforeSend: function(request) {
            request.setRequestHeader("X-CSRF-TOKEN", token);
        },
        method: "POST",
        data: {
            productId:id
        },
        success: function(data) {
            toastr.success('Product added to cart!');
        },
        error:function(xhr) {
            console.log(xhr);
        }
    })
}

function removeFromCart(id) {

    $.ajax({
        method: "DELETE",
        beforeSend: function(request) {
            request.setRequestHeader("X-CSRF-TOKEN", token);
        },
        url: baseUrl+"/remove-item",
        data:{
            productId:id

        },
        success: function(data) {
            let trToRemove = $("#cartItem_" + id);
            trToRemove.remove();
            location.reload();
        },
        error: function(xhr) {
            console.log(xhr)
        }
    })
}

function changeQuantity(productId, price,count,element) {
    $.ajax({
        url: "/cart",
        method: "PATCH",
        data: {
            productId : productId,
            quantity: element.value
        },
        success: function() {
                $("#price_" + productId).html(element.value * price +"$")
        },
        error: function (xhr) {
            console.log(xhr);
        }
    })
}

function deleteMsg(id,token) {
        $.ajax({
            method: "DELETE",
            beforeSend: function(request) {
                request.setRequestHeader("X-CSRF-TOKEN", token);
            },
            url: baseUrl+"/delete-msg",
            data:{
                msgId:id,
            },
            success: function(data) {
                let trToRemove = $("#msgId_" + id);
                trToRemove.remove();
                location.reload();
            },
            error: function(xhr) {
                console.log(xhr)
            }
        })
}

function deleteOrder(id) {
    $.ajax({
        method: "DELETE",
        beforeSend: function(request) {
            request.setRequestHeader("X-CSRF-TOKEN", token);
        },
        url: baseUrl+"/delete-order",
        data:{
            "orderId":id
        },
        success: function(data) {
            let trToRemove = $("#orderId_" + id);
            trToRemove.remove();

        },
        error: function(xhr) {
            console.log(xhr)
        }
    })
}

function deleteOrderAdmin(id) {
    $.ajax({
        method: "DELETE",
        beforeSend: function(request) {
            request.setRequestHeader("X-CSRF-TOKEN", token);
        },
        url: baseUrl+"/delete-order-admin",
        data:{
            "orderId":id
        },
        success: function(data) {
            let trToRemove = $("#orderId_" + id);
            trToRemove.remove();

        },
        error: function(xhr) {
            console.log(xhr)
        }
    })
}

function deleteUser(id) {
    $.ajax({
        method: "DELETE",
        beforeSend: function(request) {
            request.setRequestHeader("X-CSRF-TOKEN", token);
        },
        url: baseUrl+"/delete-user",
        data:{
            "userId":id
        },
        success: function(data) {
            let trToRemove = $("#userId_" + id);
            trToRemove.remove();
            toastr.success('User deleted!');

        },
        error: function(xhr) {
            console.log(xhr)
        }
    })
}

$('.btnShowOrderItems').on('click', function() {

    let id = $(this).data('id');

    $.ajax({
        method: "POST",
        beforeSend: function(request) {
            request.setRequestHeader("X-CSRF-TOKEN", token);
        },
        url: baseUrl+"/show-order-items",
        data:{
            "orderItemId":id
        },
        success: function(data) {
            console.log(id);
            displayOrderItems(data);
        },
        error: function(xhr) {
            console.log(xhr)
        }
    })
});

$('.btnShowUserParam').on('click', function(){
    let id=$(this) .data('id');

    $.ajax({
        method:'POST',
        beforeSend:function(request){
            request.setRequestHeader("X-CSRF-TOKEN",token);
        },
        url:baseUrl+"/show-user-param",
        data:{
            "userId":id
        },
        success:function(data){
            console.log(id);
            displayUserParam(data);
        }
    })
});

$('.btnShowOrderItemsAdmin').on('click', function() {

    let id = $(this).data('id');

    $.ajax({
        method: "POST",
        beforeSend: function(request) {
            request.setRequestHeader("X-CSRF-TOKEN", token);
        },
        url: baseUrl+"/show-order-items-admin",
        data:{
            "orderItemId":id
        },
        success: function(data) {
            console.log(id);
            displayOrderItemsAdmin(data);
        },
        error: function(xhr) {
            console.log(xhr)
        }
    })
});
