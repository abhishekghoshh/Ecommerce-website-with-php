<?php 
include("includes/db.php");
if(isset($_SESSION['user_name'])&&isset($_SESSION['user_id']))
{
   if(isset($_GET['id']))
   {
       $product_id=$_GET['id'];
       $sql="select * from phone where id=".$product_id;
       $item_exists=query($sql);
       $order_sql="select * from checkout where product_id=".$product_id." and user_id=".$_SESSION['user_id'];
       $order_exists=query($order_sql);
       if(row_count($item_exists)==0)
       {
           header("location: error.php");
       }
       else if(row_count($order_exists)==0)
       {
        $row=mysqli_fetch_assoc($item_exists);
           $price=$row['price'];
           $sql="insert into checkout (user_id,product_id,price) values(".$_SESSION['user_id'].",".$product_id.",".$price.")";
           $result=query($sql);
           if(!$result)
           {
               echo "Error: " . $sql . "<br>" . mysqli_error($conn);
           }   
       }
   }
    else if(isset($_GET['remove']))
    {
        $product_id=$_GET['remove'];
        $in_checkout="select * from checkout where product_id=".$product_id." and user_id=".$_SESSION['user_id'];
        $checkout_result=query($in_checkout);
        if(row_count($checkout_result)==1)
        {
           $delete_product="delete from checkout where product_id=".$product_id." and user_id=".$_SESSION['user_id'];
            $delete_result=query($delete_product);
            if(!$delete_result)
           {
               echo "Error: " . $sql . "<br>" . mysqli_error($conn);
           }   
        }   
    }
}
else
{
    header("location: signin.php");
}
include("includes/header.php");
?>


<div style="height:150px;"></div>
<!-- Page Content -->
<div class="container">
<div class="row">
    <div class="col-md-8">
        <form action="">
            <table class="table table-striped">
                <thead>
                  <tr>
                   <th>Product</th>
                   <th>Price</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        $sql="select * from checkout where user_id=".$_SESSION['user_id'];
                        $result=query($sql);
                        while($row=mysqli_fetch_assoc($result))
                        {
                            echo '<tr><td><a href="item.php?id='.$row["product_id"].'" class="btn btn-default">item '.$row["product_id"].'</a></td>
                        <td><a class="btn btn-default">₹'.$row["price"].'</a></td>
                        <td><a href="checkout.php?remove='.$row["product_id"].'" class="btn btn-danger">remove</a></td></tr>';
                        }
                    ?>   
                </tbody>
            </table>
        </form>
    </div>
    <div class="col-md-4" style="background-color:lavender;">
            <div class="container" style="top:10px;">
                <h5>Cart Totals</h5>
                <table class="table table-bordered" cellspacing="0">
                <tr class="cart-subtotal">
                <th>Items:</th>
                <td><span class="amount"><?php
                    if(isset($_SESSION['user_id']))
                    {
                        $total_sql="select * from checkout where user_id=".$_SESSION['user_id'];
                        $total_result=query($total_sql);
                        echo row_count($total_result);
                    }
                    ?></span></td>
                </tr>
                <tr class="shipping">
                <th>Shipping and Handling</th>
                <td>Free Shipping</td>
                </tr>
                <tr class="order-total">
                <th>Order Total</th>
                <td><strong><span class="amount">₹<?php
                    if(isset($_SESSION['user_id']))
                    {
                        $total_sql="select sum(price) as total_price from checkout where user_id=".$_SESSION['user_id'];
                        $total_result=query($total_sql);
                        $row=mysqli_fetch_assoc($total_result);
                        echo $row['total_price'];
                    }
                    ?></span></strong> </td>
                </tr>
                </table>
                <a type="button" class="btn btn-success" href="order.php">Order Now</a>
            </div>
        </div>
</div><!--Main Content-->
</div>

 

<?php include("includes/footer.php");
?>