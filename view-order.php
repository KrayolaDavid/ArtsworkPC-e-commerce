<?php


include('function/userfunction.php');
include('includes/header.php'); 

include('authenticate.php'); 

if(isset($_GET['t']))
{
    $tracking_no = $_GET['t'];

    $orderData = checkTrackingNoValid($tracking_no);
    if(mysqli_num_rows($orderData) < 0)
    {
        ?>
<h4>Something went wrong</h4>
<?php
        die();
    }

}
else
{
    ?>
<h4>Something went wrong</h4>
<?php
    die();
}
$data = mysqli_fetch_array($orderData)
?>

<div class="py-3 bg-info">
    <div class="container">
        <h6 class="text-white">
            <a style="text-decoration:none" class="text-white" href="index.php">
                Home /
            </a>
            <a style="text-decoration:none" class="text-white" href="my-orders.php">
                My Orders /
            </a>
            <a style="text-decoration:none" class="text-white" href="#">
                View order
            </a>
        </h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="fs-2">Order Details</span>
                            <a href="my-orders.php" class="btn btn-primary float-end"><i class="fa fa-reply"></i>Back</a>
                        </div>
                        <div class="card-body shadow">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Delivery Details</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Name</label>
                                            <div class="border p-1">
                                                <?= $data['name']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Email</label>
                                            <div class="border p-1">
                                                <?= $data['email']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Phone</label>
                                            <div class="border p-1">
                                                <?= $data['phone']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Tracking no.</label>
                                            <div class="border p-1">
                                                <?= $data['tracking_no']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Zipcode</label>
                                            <div class="border p-1">
                                                <?= $data['zipcode']; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Address</label>
                                            <div class="border p-3">
                                                <?= $data['address']; ?>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4>Order Details</h4>
                                    <hr>


                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                    <?php
                                        $userId = $_SESSION['auth_user']['user_id'];

                                        $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, oi.qty as orderqty, p.* FROM orders o, order_items oi, 
                                            products p WHERE o.user_id='$userId' AND oi.order_id=o.id AND p.id=oi.prod_id AND o.tracking_no='$tracking_no' ";
                                        $order_query_run = mysqli_query($con,$order_query);

                                        if(mysqli_num_rows($order_query_run) > 0)
                                        {
                                            foreach($order_query_run as $item)
                                            {
                                                ?>
                                                    <tr>
                                                        <td class="align-middle">                                               
                                                            <img src="upproduct/<?= $item['image']?>" alt="<?= $item['name']?>" width="60px" heigth="60px">
                                                            <?= $item['name']?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <?= $item['price']?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <?= $item['orderqty']?>
                                                        </td>
                                                    </tr>
                                                <?php
                                            }
                                        }

                                    ?>
                                        </tbody>
                                    </table>

                                    <hr>
                                    <h4>Total Price : ₱<span class="float-center fw-bold"><?= $data['total_price']?></span></h4>

                                    <hr>
                                    <label for="">Payment Mode :</label>
                                    <div class="border p-1 mb-3 fw-bold" style="border-radius: 10px;">
                                        <?= $data['payment_mode']?>
                                    </div>
                                    <label for="">Status :</label>
                                    <div class="border p-1 mb-3 fw-bold" style="border-radius: 10px;">
                                        
                                        <?php

                                            if($data['status'] == 0)
                                            {
                                                echo "Pending";
                                            }
                                            elseif($data['status'] == 1)
                                            {
                                                echo "Completed";
                                            }
                                            elseif($data["status"] == 2)
                                            {
                                                echo "Cancel";
                                            }
                                        
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php include('includes/footer.php'); ?>