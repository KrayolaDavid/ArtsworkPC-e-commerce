<?php
include('../config/dbcon.php');
include('../function/myfunction.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $category_id = $data['category_id'];
    $product_ids = $data['product_ids'];

    if (!empty($category_id) && !empty($product_ids)) {
        $product_ids_string = implode(",", array_map('intval', $product_ids));

        $update_query = "UPDATE products SET category_id='$category_id' WHERE id IN ($product_ids_string)";
        $update_query_run = mysqli_query($con, $update_query);

        if ($update_query_run) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update category.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input.']);
    }
} else {
    header('Location: ../index.php');
}
?>
