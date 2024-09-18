<?php
include('includes/header.php'); 
include('../middleware/adminmiddleware.php'); 

// Fetch total sales, orders count, and other analytics data
$sales_query = "SELECT SUM(total_price) as total_sales, COUNT(*) as total_orders FROM orders WHERE status = 1"; // Assuming 1 means completed orders
$sales_result = mysqli_query($con, $sales_query);
$sales_data = mysqli_fetch_assoc($sales_result);

$total_sales = $sales_data['total_sales'];
$total_orders = $sales_data['total_orders'];
$average_order_value = $total_orders > 0 ? $total_sales / $total_orders : 0; // Prevent division by zero

// Fetch recent orders
$recent_orders_query = "
    SELECT orders.id, orders.tracking_no, orders.total_price, orders.status, orders.created_at, users.lname 
    FROM orders 
    LEFT JOIN users ON orders.user_id = users.id 
    ORDER BY orders.id DESC LIMIT 5";
$recent_orders_result = mysqli_query($con, $recent_orders_query);
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Sales Dashboard</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title text-white">Total Sales</h5>
                                        <i class="fas fa-dollar-sign fa-2x"></i>
                                    </div>
                                    <h3 class="card-text text-white">₱<?= number_format($total_sales, 2) ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title text-white">Total Orders</h5>
                                        <i class="fas fa-shopping-cart fa-2x"></i>
                                    </div>
                                    <h3 class="card-text text-white"><?= $total_orders ?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card text-white bg-info mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title text-white">Average Order Value</h5>
                                        <i class="fas fa-chart-line fa-2x"></i>
                                    </div>
                                    <h3 class="card-text text-white">₱<?= number_format($average_order_value, 2) ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="my-4">Recent Orders</h4>
                    <table class="table table-bordered table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Last Name</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($recent_orders_result) > 0) { ?>
                                <?php while ($order = mysqli_fetch_assoc($recent_orders_result)) { ?>
                                    <tr>
                                        <td><?= $order['id'] ?></td>
                                        <td><?= isset($order['lname']) ? $order['lname'] : 'N/A' ?></td>
                                        <td>₱<?= number_format($order['total_price'], 2) ?></td>
                                        <td>
                                            <span class="badge <?= $order['status'] == 1 ? 'bg-success' : ($order['status'] == 2 ? 'bg-danger' : 'bg-warning') ?>">
                                                <?= $order['status'] == 1 ? 'Completed' : ($order['status'] == 2 ? 'Canceled' : 'Under Process') ?>
                                            </span>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="5" class="text-center">No recent orders</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
