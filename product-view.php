<?php
include('function/userfunction.php');
include('includes/header.php'); 
?>

<?php
if(isset($_GET['product']))
{
    $product_slug = $_GET['product'];
    $product_data = getSlugActive("products",$product_slug);
    $product = mysqli_fetch_array($product_data);

    if($product)
    {

        
?>
<div class="py-3 bg-info">
    <div class="container">
        <h6 class="text-white">
            <a style="text-decoration:none" class="text-white" href="index.php">
                Home /
            </a>
            <a style="text-decoration:none" class="text-white" href="components.php">
                Components /
            </a>
            <a style="text-decoration:none" class="text-white" href="components.php">
                <?php
            $category_id = $product['category_id'];
            $category_query = "SELECT name FROM components WHERE id = $category_id";
            $category_result = mysqli_query($con, $category_query);

            if ($category_result && mysqli_num_rows($category_result) > 0) {
                $category_row = mysqli_fetch_assoc($category_result);
                echo $category_row['name'];
            } else {
                echo "Category Name Not Found";
            }
            ?>
            </a>
            <a>
                <?php
                    $product_name = $product['name'];
                    $product_name_without_processor = str_replace("Processor", "", $product_name);
                    ?>
                <a>/ <?= $product_name_without_processor ?></a>
            </a>
        </h6>
    </div>
</div>
<div class="bg-light py4">
    <div class="container product_data mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="shadow">
                    <img src="upproduct/<?=$product['image']; ?>" alt="Product Image" class="w-100">
                </div>
            </div>
            <div class="col-md-8">
                <h4 style="text-decoration:none"><?= $product['name']; ?>
                    <span class="float-end text-danger"><?php if($product['trending']){echo "TRENDING";} ?></span>
                </h4>
                <hr>
                <div class="col-md-12">
                    <p><?= $product['small_description']; ?></p>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h5>₱ <span class="text-danger"
                                data-price-type="finalPrice"><?= $product['original_price']; ?></span></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4" style="width:130px">
                        <div class="input-group mb-3">
                            <button class="input-group-text decrement-btn">-</button>
                            <input type="text" class="form-control input-qty bg-white text-center" value="1" disabled>
                            <button class="input-group-text increment-btn">+</button>
                        </div>
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-md-3">
                        <button class="btn btn-success px-5 addToCartBtn" value="<?= $product['id']; ?>"> <i
                                class="fa fa-shopping-cart" aria-hidden="true"></i>Add to cart</button>
                    </div>
                    <div class="col-md-3">
                        <form action="add_to_cart_and_checkout.php" method="POST">
                            <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-danger px-5" style="text-align: center">Buynow</button>
                        </form>
                    </div>

                    <div class="col-md-3">
                        <button class="btn btn-dark px-5 addToBuildapc" value="<?= $product['id']; ?>">BUILD A
                            PC</button>
                    </div>
                </div>
            </div>



            <hr>
            <h6>Description:</h6>
            <div class="col-md-3.5">
                <p><?= $product['description']; ?></p>
            </div>
        </div>
    </div>
</div>
</div>
<?php
    }
    else
    {
        echo "Product not found";
    }
}
else
{
    echo "Something went wrong";
}
include('includes/footer.php');
?>