<?php
require("constants.php");
session_start();

$conn=mysqli_connect(HOST,USER,PASSWORD,DB);

function confirm($query)
{
    if (!$query) {
        die("Connection failed: " . mysqli_connect_error());
    }
}
function escape($query)
{
	global $conn;
	return mysqli_real_escape_string($conn,$query);
}
function query($query)
{
    global $conn;
    return mysqli_query($conn,$query);
}

function row_count($result)
{
    return mysqli_num_rows($result);
}

function alert($str)
{
    echo '<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$str.'</div>';
}

function success($str)
{
    echo '<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$str.'</div>';
}

?>