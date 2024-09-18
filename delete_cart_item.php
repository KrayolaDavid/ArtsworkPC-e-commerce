<?php
session_start();
include('config/dbcon.php');

if (isset($_POST['cart_id'])) {
    $cart_id = mysqli_real_escape_string($con, $_POST['cart_id']);
    $user_id = $_SESSION['auth_user']['user_id'];

    $chk_existing_cart = "SELECT * FROM carts WHERE id='$cart_id' AND user_id='$user_id'";
    $chk_existing_cart_run = mysqli_query($con, $chk_existing_cart);

    if (mysqli_num_rows($chk_existing_cart_run) > 0) {
        $delete_query = "DELETE FROM carts WHERE id='$cart_id'";
        $delete_query_run = mysqli_query($con, $delete_query);
        if ($delete_query_run) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete item from cart']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Item not found in cart']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
