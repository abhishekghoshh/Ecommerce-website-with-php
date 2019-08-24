<?php 
include("includes/db.php");

if(isset($_SESSION['user_name'])&&isset($_SESSION['user_id']))
{
    unset($_SESSION['user_name']);
    unset($_SESSION['user_id']);
}
header("location: signin.php");

?>