if(document.readyState == 'loading') {
    document.addEventListener('DOMContentLoading', ready)
} else {
    ready()
}

var total = 0;
var gst = 0;

function ready() {
    $(document).ready(function(){
        $('.price').each(function(){
            var price = parseFloat($(this).text().replace("Rs", ""));
            total += price;
        });
        $('#cart-total-price').text("Rs"+total);
    });
    
    $(document).ready(function(){
        gst = total * 0.18;
        gst = Math.round(gst * 100) / 100;
        $('.gst-price').text("Rs"+gst);
    })
    
    $(document).ready(function(){
        var amount =0;
        amount = gst + total;
        $('.total-price').text("Rs"+amount);
    })
    
    $(".payment").click(function(e)
    {
        e.preventDefault();
        let dishData = [];
        $("tr").each (function(){
            let objData = {
                name : $(this).find(".name").text(),
                price : parseInt($(this).find('.price').text().replace("Rs", "")),
                quantity : parseInt($(this).find(".quantity").text())
            }
            dishData.push(objData)
        })
        let gst = {gst: parseFloat($('.gst-price').text().replace("Rs",""))}
        let priceData = {total: parseFloat($('.total-price').text().replace("Rs",""))}
        dishData.push(priceData)
        dishData.push(gst)
        dishData.shift()
        var jsonArray = JSON.stringify(dishData)
        console.log(dishData)
        $.ajax({
            url: '../php/import.php',
            type: 'POST',
            data: { dishData: jsonArray},
            success: function(res){
                console.log(res);
            },
            error:function (request,status,error){
                console.log(request, status);
            }
        })
    })
}
