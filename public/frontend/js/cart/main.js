function addToCart() {
    $(".add-to-cart").click(function(){
    let id = $(this).data("id");
    let url = $('#_url').data('url');
    $.get( url + "/" + "cart/add",
        { id: id },
        function(data, status){
            if(data.code === 200){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Đã thêm vào giỏ hàng!',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
    });
}

function changeQuantityInput(className) {
    $(className).click(function(event){
        event.preventDefault();
        var that = $(this);
        let url = $('#_url').data('url');
        let qtyChange = $(this).data('qty');
        let qty = $(this).parent().find('.cart_quantity_input').val();
        let product_id = $(this).parent().find('.cart_quantity_input').data('product_id');
        
        qtyChange = parseInt(qtyChange);
        qty = parseInt(qty) + qtyChange;
        $(this).parent().find('.cart_quantity_input').val(qty);
        if (qty <= 0) {
            deleteAjaxCart(product_id, that);
            
        }else{
            updateAjaxCart(product_id, qty, that);
        }
        
    });
}

function updateAjaxCart(product_id, qty, output) {
    let url = $('#_url').data('url');
    $.get( url + "/" + "cart/update",
        { product_id, qty },
        function(data, status){
            console.log(data);
            if(data.code === 200){
                output.parents('tr').find('.cart_total_price').text(data.sub_total + ' đ');
                $('#qty-final').text(data.total_qty);
                $('#total-final').text(data.total + ' đ');
                
            }
        });
}

function deleteAjaxCart(product_id, output) {
    let url = $('#_url').data('url');
    $.get( url + "/" + "cart/delete",
        { product_id },
        function(data, status){
            if(data.code === 200){
                output.parents('tr').remove();
                $('#qty-final').text(data.total_qty);
                $('#total-final').text(data.total + ' đ');
            }
        });
}