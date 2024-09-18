$(document).ready(function () {
    $('.increment-btn').click(function (e) {
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;

        if (value < 10) {
            value++;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });
    $('.decrement-btn').click(function (e) {
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;

        if (value > 1) {
            value--;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });

    $('.addToCartBtn').click(function (e) {
        e.preventDefault();

        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).val();

        $.ajax({
            method: "POST",
            url: "function/handlecart.php",
            data: {
                "scope": 'add',
                "prod_id": prod_id, // Send the product ID to the server
                "prod_qty": qty
            },

            success: function (response) {
                console.log("Response:", response); // Log the response value

                if (response == 201) {
                    alertify.success("Product added to cart");
                } else if (response == 301) {
                    alertify.success("Product already in cart");
                } else if (response == 401) {
                    alertify.success("Log in to continue");
                } else if (response == 500) {
                    alertify.success("Something went wrong");
                }

            }
        });
    });

    $(document).on('click','.updateQty', function () 
    {
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).closest('.product_data').find('.prodId').val();
    
        $.ajax({
            method: "POST",
            url: "function/handlecart.php",
            data: {
                "scope": "update",
                "prod_id": prod_id, // Send the product ID to the server
                "prod_qty": qty
            },
            success: function (response) {
                //alert(response);
            }
        });
    });
    
    $(document).on('click', '.deleteItem', function () {
        var cart_id = $(this).val();
        $.ajax({
            method: "POST",
            url: "function/handlecart.php",
            data: {
                "scope": "delete",
                "cart_id": cart_id
            },
            success: function (response) {
                if (response == 200) {
                    alertify.success("Item removed successfully");
                    updateCart();
                } else {
                    alertify.error(response);
                }
            }
        });
    });
    
    function updateCart() {
        $.ajax({
            url: 'get_cart_items.php', // A separate PHP file to return the updated cart items
            method: 'GET',
            success: function (data) {
                $('#mycart').html(data); // Update the cart section with the new content
            }
        });
    }
    $(document).ready(function() {
        $('.deleteItem').click(function(e) {
            e.preventDefault();
    
            var cart_id = $(this).val();
            var $this = $(this);
    
            $.ajax({
                type: "POST",
                url: "delete_cart_item.php",
                data: {
                    'cart_id': cart_id
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 'success') {
                        // Remove the item from the DOM
                        $this.closest('.product_data').remove();
    
                        // Check if there are any items left in the cart
                        if ($('#mycart .product_data').length == 0) {
                            $('#mycart').html('<div class="card card-body shadow text-center"><h4 class="py-3">Your cart is empty</h4></div>');
                        }
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('An error occurred: ' + error);
                }
            });
        });
    });
    $('.buyNowBtn').click(function (e) {
        e.preventDefault();
    
        var qty = $(this).closest('.product_data').find('.input-qty').val();
        var prod_id = $(this).val();
    
        // Send the product ID and quantity to the checkout page
        window.location.href = "checkout.php?action=buy_now&prod_id=" + prod_id + "&qty=" + qty;
    });
    
    
});