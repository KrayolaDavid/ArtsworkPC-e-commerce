$(document).ready(function () {
    $('.addToBuildapc').click(function (e) {
        e.preventDefault();

        var prod_id = $(this).val();

        $.ajax({
            method: "POST",
            url: "function/additembuildapc.php",
            data: {
                "scope": 'add',
                "prod_id": prod_id, // Send the product ID to the server
            },

            success: function (response) {
                console.log("Response:", response); // Log the response value

                if (response == 201) {
                    alertify.success("Product added to Build A PC");
                } else if (response == 301) {
                    alertify.success("Product already in Build A PC");
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
        var prod_id = $(this).closest('.product_data').find('.prodId').val();
    
        $.ajax({
            method: "POST",
            url: "function/additembuildapc.php",
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
    
    $(document).on('click', '.clearItem', function () {
        var selected_id = $(this).val();
        $.ajax({
            method: "POST",
            url: "function/additembuildapc.php",
            data: {
                "scope": "delete",
                "selected_id": selected_id
            },
            success: function (response) {
                if (response == 200) {
                    alertify.success("Item removed successfully");
                    updateSelected();
                } else {
                    alertify.error(response);
                }
            }
        });
    });
    
    function updateSelected() {
        $.ajax({
            url: 'get_selected_items.php', // A separate PHP file to return the updated cart items
            method: 'GET',
            success: function (data) {
                $('#item').html(data); // Update the cart section with the new content
            }
        });
    }
    $(document).ready(function() {
        $('.clearItem').click(function(e) {
            e.preventDefault();
    
            var selected_id = $(this).val();
            var $this = $(this);
    
            $.ajax({
                type: "POST",
                url: "clear_selected_item.php",
                data: {
                    'selected_id': selected_id
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == 'success') {
                        // Remove the item from the DOM
                        $this.closest('.product_data').remove();
    
                        // Check if there are any items left in the cart
                        if ($('#item .product_data').length == 0) {
                            $('#item').html('<div class="card card-body shadow text-center"><h4 class="py-3">---Select Part----</h4></div>');
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
});