let btnPlus = document.querySelectorAll(".btnPlus");
let btnMinus = document.querySelectorAll(".btnMinus");
let btnAddCart = $("#btnAddCart");
$(btnPlus).click(function() {
    const prev = $(this).prev();
    let prev_value =  prev.text();
    prev_value = parseInt(prev_value) + 1;
    updateCartUrl(prev_value);
    $(prev).text(prev_value);
    console.log(prev_value);
})
$(btnMinus).click(function() {
    const next = $(this).next();
    let next_value =  next.text();
    next_value = parseInt(next_value) - 1;
    next_value = next_value <= 1 ? 1 : next_value;
    updateCartUrl(next_value);
    $(next).text(next_value);
})
function updateCartUrl(number) {
    let btnAddCartUrl = btnAddCart.data('url');
    btnAddCartUrl = `${btnAddCartUrl}/${number}`;
    btnAddCart.attr('href',btnAddCartUrl);
}
btnAddCart.click(function(e){
    e.preventDefault();
    let url = $(this).attr('href');
    $.ajax({
        type: "get",
        url: url,
        data: {action:"addToCart"},
        dataType: "json",
        success: function (response) {
            console.log(response);
            let cartTotal = response.cartTotal;
           
            successNotice("Thông báo","Thêm vào giỏ thành công");
            $("#cartTotal").text(cartTotal);
        }
    });
   
})