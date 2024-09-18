<?php

session_start();

include('../config/dbcon.php');
include('myfunction.php');

if(isset($_POST["register_btn"]))
{
    $lname = mysqli_real_escape_string($con, $_POST["lname"]);
    $fname = mysqli_real_escape_string($con, $_POST["fname"]);
    $mname = mysqli_real_escape_string($con, $_POST["mname"]);
    $address = mysqli_real_escape_string($con, $_POST["address"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $cpassword = mysqli_real_escape_string($con, $_POST["cpassword"]);
    
    $check_email_query = "SELECT email FROM users WHERE email='$email'";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_email_query_run) > 0)
    {
        $_SESSION['message'] = "Email already registered";
        header('Location: ../register.php');
    }
    else
    {
        if($password == $cpassword)
        {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO users (lname, fname, mname, address, email, password) VALUES ('$lname', '$fname', '$mname', '$address', '$email', '$hashed_password')";   
            $insert_query_run = mysqli_query($con, $insert_query);

            if($insert_query_run)
            {
                $_SESSION['message'] = "Registered Successfully";
                header('Location: ../login.php');
            }
            else
            {
                $_SESSION['message'] = "Something went wrong";
                header('Location: ../register.php');
            }
        }
        else
        {
            $_SESSION['message'] = "Passwords do not match!";
            header('Location: ../register.php');
        }
    }
}
else if(isset($_POST['login_btn']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT * FROM users WHERE email='$email'";
    $login_query_run = mysqli_query($con, $login_query);

    if(mysqli_num_rows($login_query_run) > 0) {
        $userdata = mysqli_fetch_array($login_query_run);
        if(password_verify($password, $userdata['password'])) {
            $_SESSION['auth'] = true;
    
            $user_id = $userdata['id'];
            $userlname = $userdata['lname'];
            $useremail = $userdata['email'];
            $role_as = $userdata['role_as'];
        
            $_SESSION['auth_user'] = [
                'user_id' => $user_id,
                'lname' => $userlname,
                'email' => $useremail
            ];
        
            $_SESSION['role_as'] = $role_as;
        
            if($role_as == 1) {
                redirect("../admin/sales_dashboard.php", "Welcome to Dashboard");
            } else {
                redirect("../index.php", "Logged in successfully");
            }
        } else {
            redirect("../login.php", "Invalid Credential");
        }
    } else {
        redirect("../login.php", "Invalid Credential");
    }
}
?>
