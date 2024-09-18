<?php
session_start();
include('../config/dbcon.php');
include('../function/myfunction.php');

if (isset($_POST['add_category_button'])) {
    // Add category logic
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $image = $_FILES['image']['name'];
    $path = "../uploads";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() .".". $image_ext;

    $cate_query = "INSERT INTO components 
    (name, slug, description, meta_title, meta_description, meta_keywords, status, popular, image)
    VALUES ('$name','$slug','$description','$meta_title','$meta_description','$meta_keywords','$status','$popular','$filename')";

    $cate_result_run = mysqli_query($con, $cate_query);

    if ($cate_result_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
        redirect("category.php", "Component Added Successfully");
    } else {
        redirect("category.php", "Something went wrong");
    }
}

if (isset($_POST['update_category_button'])) {
    // Update category logic
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() .".". $image_ext;
    } else {
        $update_filename = $old_image;
    }

    $path = "../uploads";
    $update_query = "UPDATE components SET name='$name', slug='$slug', description='$description',
    meta_title='$meta_title', meta_description='$meta_description', meta_keywords='$meta_keywords', 
    status='$status', popular='$popular', image='$update_filename' WHERE id='$category_id'";

    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if (file_exists("../uploads/".$old_image)) {
                unlink("../uploads/".$old_image);
            }
        }
        redirect("category.php?id=$category_id", "Category Updated Successfully");
    } else {
        redirect("edit-category.php?id=$category_id", "Category was not updated");
    }
}

if (isset($_POST['delete_category_btn'])) {
    // Delete category logic
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $category_query = "SELECT * FROM components WHERE id='$category_id'";
    $category_query_run = mysqli_query($con, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM components WHERE id='$category_id'";
    $delete_query_run = mysqli_query($con, $delete_query);

    if ($delete_query_run) {
        if (file_exists("../uploads/".$image)) {
            unlink("../uploads/".$image);
        }
        redirect("category.php", "Category deleted successfully.");
    } else {
        redirect("edit-category.php", "Failed to delete category.");
    }
}

if (isset($_POST['add_product_button'])) {
    // Add product logic
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    $image = $_FILES['image']['name'];
    $path = "../upproduct";
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() .".". $image_ext;

    if ($name != "" && $slug != "" && $description != "") {
        $product_query = "INSERT INTO products (category_id, name, slug, small_description, description, original_price, selling_price,
        qty, meta_title, meta_description, meta_keywords, status, trending, image) VALUES ('$category_id', '$name', '$slug', '$small_description', '$description', '$original_price', '$selling_price',
        '$qty', '$meta_title', '$meta_description', '$meta_keywords', '$status', '$trending', '$filename')";

        $product_query_run = mysqli_query($con, $product_query);

        if ($product_query_run) {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
            redirect("products.php", "Product Added Successfully");
        } else {
            redirect("add-products.php", "Something went wrong");
        }
    } else {
        redirect("add-products.php", "All fields need to be filled");
    }
}

if (isset($_POST['update_product_button'])) {
    // Update product logic
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    $path = "../upproduct";

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() .".". $image_ext;
    } else {
        $update_filename = $old_image;
    }

    $update_product_query = "UPDATE products SET category_id = '$category_id', name = '$name', slug = '$slug', small_description = '$small_description', description = '$description', original_price = '$original_price', selling_price = '$selling_price', 
    qty = '$qty', meta_title = '$meta_title', meta_description = '$meta_description', meta_keywords = '$meta_keywords', status = '$status', trending = '$trending', image = '$update_filename' WHERE id='$product_id'";
    $update_product_query_run = mysqli_query($con, $update_product_query);

    if ($update_product_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$update_filename);
            if (file_exists("../upproduct/".$old_image)) {
                unlink("../upproduct/".$old_image);
            }
        }
        redirect("products.php?id=$product_id", "Product Updated Successfully");
    } else {
        redirect("edit-products.php?id=$product_id", "Product was not updated");
    }
}

if (isset($_POST['update_order_btn'])) {
    // Update order status logic
    $tracking_no = $_POST['tracking_no'];
    $order_status = $_POST['order_status'];

    $update_query = "UPDATE orders SET status='$order_status' WHERE tracking_no='$tracking_no'";
    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
        $_SESSION['message'] = "Order status updated successfully";
        header('Location: order.php');
        exit(0);
    } else {
        $_SESSION['message'] = "Order status update failed";
        header('Location: order.php');
        exit(0);
    }
}

if (isset($_POST['change_category_btn'])) {
    // Change category logic
    $product_ids = json_decode($_POST['product_ids'], true);
    $category_id = $_POST['category_id'];

    if (!empty($product_ids) && $category_id != "") {
        foreach ($product_ids as $product_id) {
            $update_query = "UPDATE products SET category_id = '$category_id' WHERE id = '$product_id'";
            $update_query_run = mysqli_query($con, $update_query);
        }
        echo "Category changed successfully";
    } else {
        echo "No products selected or invalid category.";
    }
} else {
    header('Location: ../index.php');
}
?>
