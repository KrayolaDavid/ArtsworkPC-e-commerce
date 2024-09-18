<?php
session_start();
include('config/dbcon.php');

if (isset($_POST['selected_id'])) {
    $selected_id = mysqli_real_escape_string($con, $_POST['selected_id']);
    $user_id = $_SESSION['auth_user']['user_id'];

    $chk_existing_product = "SELECT * FROM selected_products WHERE id='$selected_id' AND user_id='$user_id'";
    $chk_existing_product_run = mysqli_query($con, $chk_existing_product);

    if (mysqli_num_rows($chk_existing_product_run) > 0) {
        $clear_query = "DELETE FROM selected_products WHERE id='$selected_id'";
        $clear_query_run = mysqli_query($con, $clear_query);
        if ($clear_query_run) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to clear item from Selected Category']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No items found to be cleared']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
