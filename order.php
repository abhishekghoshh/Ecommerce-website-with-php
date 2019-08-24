<?php
include ("includes/db.php");
if(isset($_SESSION['user_id']))
{
    $user_id=$_SESSION['user_id'];
    $sql="select * from checkout where user_id=".$user_id;
    $result=query($sql);
    if(row_count($result)>0)
    {
        while($row=mysqli_fetch_assoc($result))
        {
            $id=$row['id'];
            $product_id=$row['product_id'];
            $price=$row['price'];
            $delete_sql="delete from checkout where id=".$id;
            $delete_query=query($delete_sql);
            if(!$delete_query)
            {
                echo "Error: " . $delete_sql . "<br>" . mysqli_error($conn);
            }
            $insert_sql="insert into orders (user_id,product_id,price) values(".$user_id.",".$product_id.",".$price.")";
            $insert_query=query($insert_sql);
            if(!$insert_query)
            {
                echo "Error: " . $insert_sql . "<br>" . mysqli_error($conn);
            }
            header("location: index.php");
            
        }
    }
    else
    {
        header("location: checkout.php");
    }
}
else
{
    header("location: signin.php");
}
?>