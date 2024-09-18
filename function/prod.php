<?php
// Helper function to get category name
function getCategoryName($category_id) {
    global $con;
    $category_query = "SELECT name FROM components WHERE id = '$category_id'";
    $category_result = mysqli_query($con, $category_query);
    $category_data = mysqli_fetch_assoc($category_result);
    return ($category_data) ? $category_data['name'] : 'N/A';
}
?>
