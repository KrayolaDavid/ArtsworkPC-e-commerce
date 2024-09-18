<?php


include('../function/myfunction.php');

if(isset($_SESSION['auth'])) 
{
    if($_SESSION['role_as'] != 1) 
    {
        redirect("../index.php", "You are not authorized to access this page");
        ob_end_flush();
    }
    }
    else 
{
    redirect("../login.php", "log in to continue");
    ob_end_flush();
}

?>