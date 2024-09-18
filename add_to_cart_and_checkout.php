<?php
session_start();
include('function/userfunction.php');

if(isset($_POST['product_id']) && isset($_POST['qty']))
{
    $product_id = $_POST['product_id'];
    $qty = $_POST['qty'];

    // Add the product to the cart session or database
    $cart_item = [
        'product_id' => $product_id,
        'qty' => $qty,
    ];

    // Assuming you're using a session for the cart
    $_SESSION['cart'][] = $cart_item;

    // Redirect to the checkout page
    header("Location: checkout.php");
    exit();
}
else
{
    // Handle the case where the POST data is missing
    header("Location: index.php");
    exit();
}
?>
