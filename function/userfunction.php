<?php

session_start();
include('config/dbcon.php');

function getAllActive($table)
{
    global $con;
    $query = "SELECT * FROM $table WHERE status='0' ";
    return $query_run = mysqli_query($con, $query);

}
function getAllTrending()
{
    global $con;
    $query = "SELECT * FROM products WHERE trending='1' ";
    return $query_run = mysqli_query($con, $query);

}
function getSlugActive($table, $slug)
{
    global $con;
    $query = "SELECT * FROM $table WHERE slug='$slug' AND status='0' LIMIT 1";
    return $query_run = mysqli_query($con, $query);

}

function getProdByComponent($category_id)
{
    global $con;
    $query = "SELECT * FROM products WHERE category_id='$category_id' AND status='0'";
    return $query_run = mysqli_query($con, $query);
}

function getIDActive($table, $id)
{
    global $con;
    $query = "SELECT * FROM $table WHERE id='$id' AND status='0'";
    return $query_run = mysqli_query($con, $query);

}

function getCartItems()
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.original_price, p.selling_price 
                FROM carts c, products p WHERE c.prod_id=p.id AND c.user_id='$userId' ORDER BY c.id DESC";
    return $query_run = mysqli_query($con, $query);
}

function getOrders()
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM orders WHERE user_id='$userId' ORDER BY id DESC";
    return $query_run = mysqli_query($con, $query);
}

function redirect($url, $message) 
{
    $_SESSION['message'] = $message;
    header('Location: ' . $url);
    exit;
}

function checkTrackingNoValid($tracking_no)
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];

    $query = "SELECT * FROM orders WHERE tracking_no='$tracking_no' AND user_id='$userId'";
    return mysqli_query($con, $query);


}
function addToCart($prod_id, $qty)
{
    global $con;
    $user_id = $_SESSION['auth_user']['user_id'];

    // Check if the product already exists in the cart
    $chk_existing_cart = "SELECT * FROM carts WHERE prod_id='$prod_id' AND user_id='$user_id' ";
    $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

    if(mysqli_num_rows($chk_existing_cart_run) > 0) {
        // Product already exists in the cart
        return false;
    } else {
        // Insert the product into the cart
        $insert_query = "INSERT INTO carts (user_id, prod_id, prod_qty) VALUES ('$user_id','$prod_id','$qty')";
        $insert_query_run = mysqli_query($con, $insert_query);
        if($insert_query_run) {
            return true;
        } else {
            return false;
        }
    }
}
function getAllProducts() {
    global $con;
    $query = "SELECT * FROM products";
    return mysqli_query($con, $query);
}
function getSelectedItems()
{
    global $con;
    $userId = $_SESSION['auth_user']['user_id'];
    $query = "SELECT c.id as cid, c.prod_id, p.id as pid, p.name, p.image, p.category_id, p.rating
                FROM selected_products c, products p WHERE c.prod_id=p.id AND c.user_id='$userId' ORDER BY c.id DESC";
    return $query_run = mysqli_query($con, $query);
}

?>