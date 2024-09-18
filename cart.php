<?php
include('function/userfunction.php');
include('authenticate.php');
include('includes/header.php');
?>

<div class="py-3 bg-info">
    <div class="container">
        <h6 class="text-white">
            <a style="text-decoration:none" class="text-white" href="index.php">Home /</a>
            <a style="text-decoration:none" class="text-white" href="cart.php">Cart</a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="mycart">
                    <?php
                    $items = getCartItems();
                    if(mysqli_num_rows($items) > 0){
                    ?>
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <h6>Products</h6>
                            </div>
                            <div class="col-md-3">
                                <h6>Name</h6>
                            </div>
                            <div class="col-md-2">
                                <h6>Price</h6>
                            </div>
                            <div class="col-md-2">
                                <h6>Quantity</h6>
                            </div>
                            <div class="col-md-2">
                                <h6>Action</h6>
                            </div>
                        </div>
                        <div id="cart-items-container">
                            <?php
                            foreach($items as $citem) {
                            ?>
                                <div class="card product_data shadow-sm mb-2">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <img src="upproduct/<?= $citem['image'] ?>" alt="Image" width="120px">
                                        </div>
                                        <div class="col-md-4">
                                            <h5><?= $citem['name'] ?></h5>
                                        </div>
                                        <div class="col-md-2">
                                            <h5>₱<?= $citem['original_price'] ?></h5>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="hidden" class="prodId" value="<?= $citem['prod_id'] ?>">
                                            <div class="input-group mb-3" style="width: 130px;">
                                                <button class="input-group-text decrement-btn updateQty">-</button>
                                                <input type="text" class="form-control input-qty bg-white text-center" value="<?= $citem['prod_qty'] ?>" disabled>
                                                <button class="input-group-text increment-btn updateQty">+</button>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-danger deleteItem" value="<?= $citem['cid'] ?>">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="float-end">
                            <a href="checkout.php" class="btn btn-outline-danger">Check out</a>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="card card-body shadow text-center">
                            <h4 class="py-3">Your cart is empty</h4>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
