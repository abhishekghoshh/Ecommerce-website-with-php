<?php 
include("includes/db.php");

if(isset($_SESSION['user_name'])&&isset($_SESSION['user_id']))
{
    header("location: index.php");
}

if(isset($_POST['sign']))
{
    $error=array();
    $email=trim($_POST['sign_email']);
    $pwd=trim($_POST['sign_pwd']);

    $result=query("select * from user where email='".$email."'");
    if(row_count($result)==0)
    {
        $error['email_exists']="Email is not registered with us";
    }
    else
    {
        $row=mysqli_fetch_assoc($result);
        if(md5($pwd)==$row['password'])
        {
            $_SESSION['user_id']=$row['id'];
            $_SESSION['user_name']=$row['name'];
            header("location: index.php");
        }
        else
        {
            $error['cnf_pwd']="Password does not match";
        }
    }
}
include("includes/header.php");
?>
    <div style="height:150px;"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4">
                <form action="signin.php" method="post">
                    <div class="form-group">
                      <label for="sign_email">Email:</label>
                      <input type="email" class="form-control" id="sign_email" placeholder="Enter email" name="sign_email" required>
                    </div>
                    <?php
                    if(isset($error['email_exists']))
                        {
                            alert($error['email_exists']);
                        }
                        ?>
                    <div class="form-group">
                      <label for="sign_pwd">Password:</label>
                      <input type="password" class="form-control" id="sign_pwd" placeholder="Enter password" name="sign_pwd" required>
                    </div>
                    <?php
                    if(isset($error['cnf_pwd']))
                        {
                            alert($error['cnf_pwd']);
                        }
                        ?>
                    <button type="submit" class="btn btn-default" name="sign">Log in</button>
              </form>
            </div>
            <div class="col-sm-4">
            </div>
        </div>
   
    </div>

	<!-- Footer -->

	<?php include("includes/footer.php");