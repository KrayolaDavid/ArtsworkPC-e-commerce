<?php
include('function/userfunction.php');
include('includes/header.php'); 
include('authenticate.php'); 

if(isset($_GET['action']) && $_GET['action'] == "buy_now" && isset($_GET['prod_id']) && isset($_GET['qty'])) {
    $prod_id = $_GET['prod_id'];
    $qty = $_GET['qty'];

    // Add the selected item to the cart
    addToCart($prod_id, $qty);

    // Redirect to checkout page with the added item
    header("Location: checkout.php");
    exit();
}
?>

<div class="py-3 bg-info">
    <div class="container">
        <h6 class="text-white">
            <a style="text-decoration:none" class="text-white" href="index.php">
                Home /
            </a>
            <a style="text-decoration:none" class="text-white" href="checkout.php">
                Checkout
            </a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="card">
            <div class="card-body shadow">
                <form action="function/placeorder.php" method="POST" id="checkoutForm">
                    <div class="row">
                        <div class="col-md-7">
                            <h5>Details</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Name</label>
                                    <input type="text" name="name" id="name" required placeholder="Enter your full name"
                                        class="form-control">
                                    <small class="text-danger name"></small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">E-mail</label>
                                    <input type="email" name="email" id="email" required placeholder="Enter your email"
                                        class="form-control">
                                    <small class="text-danger email"></small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Phone No.</label>
                                    <input type="text" name="phone" id="phone" required placeholder="Enter your phone"
                                        class="form-control">
                                    <small class="text-danger phone"></small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Zipcode</label>
                                    <input type="text" name="zipcode" id="zipcode" required
                                        placeholder="Enter your zipcode" class="form-control">
                                    <small class="text-danger zipcode"></small>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold">Address</label>
                                    <textarea name="address" id="address" required placeholder="Enter your address"
                                        class="form-control" rows="5"></textarea>
                                    <small class="text-danger address"></small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="row align-items-center">
                                <h5>Order Details</h5>
                                <hr>
                                <?php 
                                $items = getCartItems();
                                $totalprice = 0;
                                foreach($items as $citem) { ?>
                                <div class="mb-1 border">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <img src="upproduct/<?= $citem['image'] ?>" alt="Image" width="80px">
                                        </div>
                                        <div class="col-md-4">
                                            <h5><?= strlen($citem['name']) > 20 ? substr($citem['name'], 0, 20) . '...' : $citem['name'] ?>
                                            </h5>
                                        </div>
                                        <div class="col-md-3">
                                            <h5><?= $citem['original_price'] ?></h5>
                                        </div>
                                        <div class="col-md-3">
                                            <h5><?= $citem['prod_qty'] ?></h5>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    $totalprice += $citem['original_price'] * $citem['prod_qty'];
                                } ?>
                                <hr>
                                <h5>Total Price: <span class="float-center fw-bold"><?=$totalprice?></span></h5>
                                <div class="col-md-4 d-flex align-items-end">
                                    <form action="placeorderCOD.php" method="POST">
                                    <input type="hidden" name="payment_mode" value="COD(Cash On Delivery)">
                                    <button type="submit" name="placeOrderBtnCod" class="btn btn-primary w-100">Confirm Order</button>
                                </form>
                                </div>
                                <div id="paypal-button-container" style="margin-top: 20px;"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
include('includes/footer.php'); 
?>

<script
    src="https://www.paypal.com/sdk/js?client-id=AfJHrde1zyxDjEOZX0M955S-ZjnbuBAhpws7hTLl0uSEzLbSr4gqRGy66ZwO0Ko1sBUrjtskh_M9CnEe&currency=PHP">
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        paypal.Buttons({
            onClick: function (data, actions) {
                // Clear previous error messages
                document.querySelector('.name').textContent = '';
                document.querySelector('.email').textContent = '';
                document.querySelector('.phone').textContent = '';
                document.querySelector('.zipcode').textContent = '';
                document.querySelector('.address').textContent = '';

                // Fetch values from form fields
                var name = document.getElementById('name').value;
                var email = document.getElementById('email').value;
                var phone = document.getElementById('phone').value;
                var zipcode = document.getElementById('zipcode').value;
                var address = document.getElementById('address').value;

                // Validate form fields
                var isValid = true;
                if (name.length === 0) {
                    document.querySelector('.name').textContent = "This field is required";
                    isValid = false;
                }
                if (email.length === 0) {
                    document.querySelector('.email').textContent = "This field is required";
                    isValid = false;
                }
                if (phone.length === 0) {
                    document.querySelector('.phone').textContent = "This field is required";
                    isValid = false;
                }
                if (zipcode.length === 0) {
                    document.querySelector('.zipcode').textContent = "This field is required";
                    isValid = false;
                }
                if (address.length === 0) {
                    document.querySelector('.address').textContent = "This field is required";
                    isValid = false;
                }

                // Prevent the PayPal button from proceeding if any field is empty
                if (!isValid) {
                    return actions.reject();
                }
                return actions.resolve();
            },
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?=$totalprice?>' // Replace with the amount to charge
                        }
                    }]
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (details) {
                    var name = document.getElementById('name').value;
                    var email = document.getElementById('email').value;
                    var phone = document.getElementById('phone').value;
                    var zipcode = document.getElementById('zipcode').value;
                    var address = document.getElementById('address').value;

                    var formData = new FormData();
                    formData.append('name', name);
                    formData.append('email', email);
                    formData.append('phone', phone);
                    formData.append('zipcode', zipcode);
                    formData.append('address', address);
                    formData.append('payment_mode', "Paid by Paypal");
                    formData.append('payment_id', details.id);
                    formData.append('placeOrderBtn', true);

                    $.ajax({
                        method: "POST",
                        url: "function/placeorder.php",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response == 201) {
                                alertify.success('Order Placed Successfully');
                                setTimeout(function () {
                                    window.location.href =
                                        'my-orders.php';
                                }, 1000);
                            } else {
                                alertify.error('Failed to Place Order');
                            }
                        },
                        error: function () {
                            alertify.error('Error: Unable to Place Order');
                        }
                    });

                });
            }

        }).render('#paypal-button-container');
    });
</script>