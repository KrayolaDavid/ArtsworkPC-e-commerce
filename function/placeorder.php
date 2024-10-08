<?php
session_start();
include('../config/dbcon.php');

if (isset($_SESSION['auth'])) {
    if (isset($_POST['placeOrderBtn'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $zipcode = mysqli_real_escape_string($con, $_POST['zipcode']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $payment_mode = mysqli_real_escape_string($con, $_POST['payment_mode']);
        $payment_id = mysqli_real_escape_string($con, $_POST['payment_id']);

        if ($name == "" || $email == "" || $phone == "" || $zipcode == "" || $address == "") {
            $_SESSION['message'] = "All fields are mandatory";
            header('Location: ../checkout.php');
            exit();
        }

        $userId = $_SESSION['auth_user']['user_id'];
        $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.original_price, p.qty as available_qty 
                  FROM carts c, products p 
                  WHERE c.prod_id=p.id AND c.user_id='$userId' 
                  ORDER BY c.id DESC";

        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $totalprice = 0;
            foreach($query_run as $citem) {
                $totalprice += $citem['original_price'] * $citem['prod_qty'];
            }

            $tracking_no = rand(11111, 99999) . substr($phone, 2);
            $insert_query = "INSERT INTO orders (tracking_no, user_id, name, email, phone, address, zipcode, total_price, payment_mode, payment_id) 
                             VALUES ('$tracking_no','$userId','$name','$email','$phone','$address','$zipcode','$totalprice','$payment_mode','$payment_id')";

            $insert_query_run = mysqli_query($con, $insert_query);

            if ($insert_query_run) {
                $order_id = mysqli_insert_id($con);
                foreach($query_run as $citem) {
                    $prod_id = $citem['prod_id'];
                    $prod_qty = $citem['prod_qty'];
                    $price = $citem['original_price'];
                    
                    $insert_items_query = "INSERT INTO order_items (order_id, prod_id, qty, price) 
                                           VALUES ('$order_id','$prod_id','$prod_qty','$price')";
                    $insert_items_query_run = mysqli_query($con, $insert_items_query);

                    if ($insert_items_query_run) {
                        $product_query = "SELECT qty FROM products WHERE id='$prod_id' LIMIT 1";
                        $product_query_run = mysqli_query($con, $product_query);

                        if ($product_query_run) {
                            $productData = mysqli_fetch_array($product_query_run);
                            $current_qty = $productData['qty'];
                            $new_qty = $current_qty - $prod_qty;

                            $updateQty_query = "UPDATE products SET qty='$new_qty' WHERE id='$prod_id'";
                            $updateQty_run = mysqli_query($con, $updateQty_query);

                            if (!$updateQty_run) {
                                echo "Error updating product quantity: " . mysqli_error($con);
                                exit();
                            }
                        } else {
                            echo "Error fetching product data: " . mysqli_error($con);
                            exit();
                        }
                    } else {
                        echo "Error inserting order items: " . mysqli_error($con);
                        exit();
                    }
                }

                $deleteCart_query = "DELETE FROM carts WHERE user_id='$userId'";
                $deleteCart_query_run = mysqli_query($con, $deleteCart_query);


                if($payment_mode == "COD"){
                    $_SESSION['message'] = "Order placed successfully and cart cleared";
                    header('Location: ../my-orders.php');
                    exit();
                }else{
                    echo 201;
                }
 
            } 
        } 
    }
} else {
    header('Location: ../index.php');
    exit();
}
if (isset($_SESSION['auth'])) {
    if (isset($_POST['placeOrderBtnCod'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $phone = mysqli_real_escape_string($con, $_POST['phone']);
        $zipcode = mysqli_real_escape_string($con, $_POST['zipcode']);
        $address = mysqli_real_escape_string($con, $_POST['address']);
        $payment_mode = mysqli_real_escape_string($con, $_POST['payment_mode']);
        $payment_id = mysqli_real_escape_string($con, $_POST['payment_id']);

        if ($name == "" || $email == "" || $phone == "" || $zipcode == "" || $address == "") {
            $_SESSION['message'] = "All fields are mandatory";
            header('Location: ../checkout.php');
            exit();
        }

        $userId = $_SESSION['auth_user']['user_id'];
        $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.original_price, p.qty as available_qty 
                  FROM carts c, products p 
                  WHERE c.prod_id=p.id AND c.user_id='$userId' 
                  ORDER BY c.id DESC";

        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $totalprice = 0;
            foreach($query_run as $citem) {
                $totalprice += $citem['original_price'] * $citem['prod_qty'];
            }

            $tracking_no = rand(11111, 99999) . substr($phone, 2);
            $insert_query = "INSERT INTO orders (tracking_no, user_id, name, email, phone, address, zipcode, total_price, payment_mode, payment_id) 
                             VALUES ('$tracking_no','$userId','$name','$email','$phone','$address','$zipcode','$totalprice','$payment_mode','$payment_id')";

            $insert_query_run = mysqli_query($con, $insert_query);

            if ($insert_query_run) {
                $order_id = mysqli_insert_id($con);
                foreach($query_run as $citem) {
                    $prod_id = $citem['prod_id'];
                    $prod_qty = $citem['prod_qty'];
                    $price = $citem['original_price'];
                    
                    $insert_items_query = "INSERT INTO order_items (order_id, prod_id, qty, price) 
                                           VALUES ('$order_id','$prod_id','$prod_qty','$price')";
                    $insert_items_query_run = mysqli_query($con, $insert_items_query);

                    if ($insert_items_query_run) {
                        $product_query = "SELECT qty FROM products WHERE id='$prod_id' LIMIT 1";
                        $product_query_run = mysqli_query($con, $product_query);

                        if ($product_query_run) {
                            $productData = mysqli_fetch_array($product_query_run);
                            $current_qty = $productData['qty'];
                            $new_qty = $current_qty - $prod_qty;

                            $updateQty_query = "UPDATE products SET qty='$new_qty' WHERE id='$prod_id'";
                            $updateQty_run = mysqli_query($con, $updateQty_query);

                            if (!$updateQty_run) {
                                echo "Error updating product quantity: " . mysqli_error($con);
                                exit();
                            }
                        } else {
                            echo "Error fetching product data: " . mysqli_error($con);
                            exit();
                        }
                    } else {
                        echo "Error inserting order items: " . mysqli_error($con);
                        exit();
                    }
                }

                $deleteCart_query = "DELETE FROM carts WHERE user_id='$userId'";
                $deleteCart_query_run = mysqli_query($con, $deleteCart_query);

                if ($deleteCart_query_run) {
                    $_SESSION['message'] = "Order placed successfully and cart cleared";
                    header('Location: ../my-orders.php');
                    exit();
                } else {
                    echo "Error clearing cart: " . mysqli_error($con);
                    exit();
                }
            } else {
                echo "Error placing order: " . mysqli_error($con);
                exit();
            }
        } else {
            echo "Query failed: " . mysqli_error($con);
            exit();
        }
    }
} else {
    header('Location: ../index.php');
    exit();
}
?>
