<?php 
include("includes/db.php");

if(isset($_SESSION['user_name'])&&isset($_SESSION['user_id']))
{
    header("location: index.php");
}

if(isset($_POST['signup']))
{
    $error=array();
    $name=trim($_POST['reg_name']);
    $email=trim($_POST['reg_email']);
    $pwd=trim($_POST['reg_pwd']);
    $cnf_pwd=trim($_POST['cnf_pwd']);
    if(strlen($name)<8 || strlen(strlen($name))>50)
    {
        $error['name_length']="Name size must be in between 8 to 50";
    }
    $result=query("select * from user where email='".$email."'");
    if(row_count($result)==1)
    {
        $error['email_exists']="Email is already exists";
    }
    if(strlen($pwd)<8)
    {
        $error['pwd']="Your password is too small";
    }
    if($pwd!=$cnf_pwd)
    {
        $error['cnf_pwd']="Password does not match";
    }
    if(empty($error))
    {
        $pwd=md5($pwd);
        $sql="INSERT INTO user (name, email, password) VALUES ('".$name."', '".$email."', '".$pwd."')";
        if(query($sql))
        {
            $success="You are successfully registered";
        }
        else
        {
            $failure="Oops There is a problem";
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
                <form action="register.php" method="post"> 
                    <div class="form-group">
                      <label for="reg_name">Name:</label>
                      <input type="text" class="form-control" id="reg_name" placeholder="Enter name" name="reg_name" required>
                        <?php
                        if(isset($error['name_length']))
                        {
                            alert($error['name_length']);
                        }
                        ?>
                    </div>
                    <div class="form-group">
                      <label for="reg_email">Email:</label>
                      <input type="email" class="form-control" id="reg_email" placeholder="Enter email" name="reg_email" required>
                    </div>
                    <?php
                    if(isset($error['email_exists']))
                        {
                            alert($error['email_exists']);
                        }
                        ?>
                    <div class="form-group">
                      <label for="reg_pwd">Password:</label>
                      <input type="password" class="form-control" id="reg_pwd" placeholder="Enter password" name="reg_pwd" required>
                    </div>
                    
                    <?php
                        if(isset($error['pwd']))
                        {
                            alert($error['pwd']);
                        }
                        ?>
                    <div class="form-group">
                      <label for="cnf_pwd">Confirm Password:</label>
                      <input type="password" class="form-control" id="cnf_pwd" placeholder="Confirm password" name="cnf_pwd" required>
                    </div>
                    <?php
                    if(isset($error['cnf_pwd']))
                        {
                            alert($error['cnf_pwd']);
                        }
                    if(isset($success))
                        {
                            success($success);
                        }
                    if(isset($failure))
                        {
                            alert($failure);
                        }
                        ?>
                    <button type="submit" class="btn btn-default" id="signup" name="signup">Sign Up</button>
                    
              </form>
            </div>
            <div class="col-sm-4">
            </div>
        </div>
   
    </div>
	<!-- Footer -->

	<?php include("includes/footer.php");