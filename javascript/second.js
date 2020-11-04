if(document.readyState == 'loading') {
    document.addEventListener('DOMContentLoading', ready)
} else {
    ready()
}


function ready(){
    var removeCartItemButtons = document.getElementsByClassName('btn-danger')
    for(var i = 0; i < removeCartItemButtons.length; i++){
        var button = removeCartItemButtons[i]
        button.addEventListener('click', removeCartItem)
    }

    var quantityInputs = document.getElementsByClassName('cart-quantity-input')
    for(var i = 0; i < quantityInputs.length; i++){
        var input = quantityInputs[i]
        input.addEventListener('click', quantityChanged)
    }

    var modal = document.getElementsByClassName('popup')[0]

    var viewOrderButton = document.getElementsByClassName('open-popup')[0]
    viewOrderButton.addEventListener('click', function(){
        modal.style.display = "block";
    })

    var closePopupButton = document.getElementsByClassName('close-popup')[0]
    closePopupButton.addEventListener('click', function(){
        modal.style.display = "none";
    })

    window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
    }


    var name;
    var price;

    $(".butt").click(function(data){
        name = $(this).closest('tr').find('.name').text();
        price = $(this).closest('tr').find('.price').text();
        var cartRow = document.createElement('div')
        cartRow.classList.add('cart-row')
        var cartItems = document.getElementsByClassName('cart-items')[0]
        var cartItemNames = document.getElementsByClassName('cart-item-title')
        var cartItemPrices = document.getElementsByClassName('cart-price')
        for (var i = 0; i < cartItemNames.length; i++){
            if(cartItemNames[i].innerText == name){
                alert("This item is already added to the cart")
                return 
            }
        }
        var cartRowContents = `
            <div class="cart-item cart-column">
            <!--<img class="cart-item-image" src="Images/Shirt.png" width="100" height="100"> -->
                <div class="cart-item-title">${name}</div>
            </div>
            <div class="cart-price cart-column">${price}</div>
            <div class="cart-quantity cart-column">
                <input class="cart-quantity-input" type="number" name="quantity" value="1">
                <button class="btn btn-danger circle minus" type="button">&times;</button>
            </div>`
        cartRow.innerHTML = cartRowContents
        cartItems.append(cartRow)
        cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeCartItem)
        cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('click', quantityChanged)
        updateCartTotal()
    });

    // var sendToChefButton = document.getElementsByClassName('btn-send')[0];
    // sendToChefButton.addEventListener('click', sendToChef)
    $('.btn-send').click(function (e){
        e.preventDefault();
        let dishData = [];
        $('.cart-row').each(function () {
          let objectDish = {
            name: $(this).find('.cart-item-title').text(),
            dishPrice: parseInt($(this).find('.cart-price').text().replace("Rs", "")),
            quantity: $(this).find('.cart-quantity-input').val(),
            finalPrice: (parseInt($(this).find('.cart-price').text().replace("Rs", ""))) * ($(this).find(
              '.cart-quantity-input').val())
          }
          dishData.push(objectDish)
        })
        console.log("added", {
          dishData
        })
        var jsonArray = JSON.stringify(dishData);

        // let pre = document.querySelector(".pre")
        // pre.textContent = '\n' + JSON.stringify(dishData, '\t', 2);
        $.ajax({
          url: 'session.php',
          type: 'POST',
          data: { dishData: jsonArray },
          success: function (res) {
            console.log(res);
            window.location = "third.php";
          },
            error:function (request,status,error){alert(request, status);}
        })
    });
}


// function sendToChef(event){
//     var butt;
//     alert("The send to chef button")
//     // var button = event.target;
//     // var c = button.parentElement
//     var cartRows = document.getElementsByClassName("cart-row")[0];
//     for (var i = 0; i < cartRows.length; i++){
//         var cartRo = cartRows[i];
//         var butt = cartRo.getElementsByClassName("cart-item-title")[0].innerText;
//         console.log(butt)
//     }
    
// }

function quantityChanged(event){
    var input = event.target
    if (isNaN(input.value) || input.value <= 0){
        input.value = 1
    }
    updateCartTotal()
}

function removeCartItem(event){
    var buttonClicked = event.target
    buttonClicked.parentElement.parentElement.remove()
    updateCartTotal()
}

function updateCartTotal(){
    var cartItemContainer = document.getElementsByClassName('cart-items')[0]
    var cartRows = cartItemContainer.getElementsByClassName('cart-row')
    var total = 0
    for(var i = 0; i < cartRows.length; i++){
        var cartRow = cartRows[i]
        var priceElement = cartRow.getElementsByClassName('cart-price')[0]
        var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
        var price = parseFloat(priceElement.innerText.replace('Rs', ''))
        var quantity = quantityElement.value
        total = total + (price * quantity)
    }
    total = Math.round(total * 100) / 100
    document.getElementsByClassName('cart-total-price')[0].innerText = 'Rs' + total
}