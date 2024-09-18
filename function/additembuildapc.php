<?php
session_start();
include('../config/dbcon.php');

if(isset($_SESSION['auth'])) {
    if(isset($_POST['scope'])) {   
        $scope = $_POST['scope'];
        switch ($scope) {
            case "add":
                $prod_id = $_POST['prod_id'];
                $user_id = $_SESSION['auth_user']['user_id'];

                $chk_existing_product = "SELECT * FROM selected_products WHERE prod_id='$prod_id' AND user_id='$user_id' ";
                $chk_existing_product_run = mysqli_query($con, $chk_existing_product);

                if(mysqli_num_rows($chk_existing_product_run) > 0) {
                    echo 301; // Product already exists in the cart
                } else {
                    $insert_query = "INSERT INTO selected_products (user_id, prod_id) VALUES ('$user_id','$prod_id')";
                    $insert_query_run = mysqli_query($con, $insert_query);
                    if($insert_query_run) {
                        echo 201; 
                    } else {
                        echo 500; 
                    }
                }    
                break;
                case "update":
                    $prod_id = $_POST['prod_id'];

                    $user_id = $_SESSION['auth_user']['user_id'];

                    $chk_existing_product = "SELECT * FROM selected_products WHERE prod_id='$prod_id' AND user_id='$user_id' ";
                    $chk_existing_product_run = mysqli_query($con, $chk_existing_product);
    
                    if(mysqli_num_rows($chk_existing_product_run) > 0) 
                    {
                        $update_query = "UPDATE selected_products SET prod_qty='$prod_qty' WHERE prod_id='$prod_id' AND user_id='$user_id'";
                        $update_query_run = mysqli_query($con, $update_query);
                        if($update_query_run){
                            echo 200;
                        }
                        else {
                            echo "somethingwenwrong";
                        }
                    } else 
                    {
                        echo "somethingwenwrong";
                    } 
                    break;



                    case "delete":
                        $selected_id = $_POST['selected_id'];

                        $user_id = $_SESSION['auth_user']['user_id'];

                        $chk_existing_product = "SELECT * FROM selected_products WHERE id='$selected_id' AND user_id='$user_id' ";
                        $chk_existing_product_run = mysqli_query($con, $chk_existing_product);

                        if(mysqli_num_rows($chk_existing_product_run) > 0) 
                    {
                        $delete_query = "DELETE FROM selected_products WHERE id='$selected_id'";
                        $delete_query_run = mysqli_query($con, $delete_query);
                        if($delete_query_run){
                            echo 200;
                        }
                        else {
                            echo "removed";
                        }
                    } else 
                    {
                        echo "Removed";
                    } 
                    break;



            default:
                echo 500; 
        }
    }
} 
else 
{
    echo 401; 
}
?>
