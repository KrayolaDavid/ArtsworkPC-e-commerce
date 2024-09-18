<?php

include('includes/header.php'); 
include('../middleware/adminmiddleware.php');



?>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>All Orders
                    <a href="order-history.php" class="btn btn-info float-end">Order History</a>
                    </h4>
                    
                </div>
                    <table class="table table-bordered table-striped ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Users</th>
                                <th>Tracking no.</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>View details</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $orders = getAllOrders();

                        if(mysqli_num_rows($orders) > 0)
                        {
                            foreach ($orders as $item)
                            {
                            ?>
                                <tr>
                                    <td><?= $item['id']?></td>
                                    <td><?= $item['lname']?></td>
                                    <td><?= $item['tracking_no']?></td>
                                    <td><?= $item['total_price']?></td>
                                    <td><?= $item['created_at']?></td>
                                    <td>
                                        <a href="view-order.php?t=<?= $item['tracking_no']?>" class="btn btn-primary">View details</a>
                                    </td>
                                </tr>
                            <?php
                            }
                        }
                        else
                        {
                           ?>
                                <tr>
                                    <td colspan="5"> No orders yet</td>
                                </tr>
                           <?php
                        }
                    
                    
                        ?>
                            
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>