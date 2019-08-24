
<!DOCTYPE html>
<html lang="en">
<head>
<title>Mobile Wire</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Colo Shop Template">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
<link rel="stylesheet" type="text/css" href="styles/categories_styles.css">
<link rel="stylesheet" type="text/css" href="styles/categories_responsive.css">
<link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
<link rel="stylesheet" type="text/css" href="styles/single_styles.css">
<link rel="stylesheet" type="text/css" href="styles/single_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/contact_styles.css">
<link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
</head>

<body>

<div class="super_container">

	<!-- Header -->

	<header class="header trans_300">
		<!-- Main Navigation -->
        
		<div class="main_nav_container">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-right">
						<div class="logo_container">
							<a href="index.php">Mobile<span>Wire</span></a>
						</div>
						<nav class="navbar">
							<ul class="navbar_menu">
								<li><a href="index.php">home</a></li>
								<li><a href="categories.php">Categories</a></li>
								<li><a href="contact.php">contact</a></li>
							</ul>
                            <div class="top_nav_right">
							<ul class="top_nav_menu">
                                <?php
                                if(isset($_SESSION['user_name'])&&isset($_SESSION['user_id']))
                                {
                                    echo '
								<!-- My Account -->
								<li class="account"style="background:#FFF;">
									<a href="#">
                                        '.$_SESSION['user_name'].'
										<i class="fa fa-angle-down" ></i>
									</a>
									<ul class="account_selection">
										<li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Log out</a></li>
									</ul>
								</li>';
                                }
                                else
                                {
                                    echo '
								<!-- My Account -->
								<li class="account"style="background:#FFF;">
									<a href="#">
                                        My Account
										<i class="fa fa-angle-down" ></i>
									</a>
									<ul class="account_selection">
										<li><a href="signin.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
										<li><a href="register.php"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
									</ul>
								</li>';
                                }
                                ?>
							</ul>
						</div>
							<ul class="navbar_user">
								<li class="checkout">
									<a href="checkout.php">
										<i class="fa fa-shopping-cart" aria-hidden="true"></i>
										<span id="checkout_items" class="checkout_items">
                                            <?php
                                            if(isset($_SESSION['user_name'])&&isset($_SESSION['user_id']))
                                            {
                                            $num_sql="select * from checkout where user_id=".$_SESSION['user_id'];
                                            $num_sql=query($num_sql);
                                            echo row_count($num_sql);
                                            }
                                            else
                                            {
                                                echo 0;
                                            }
                                            ?>
                                        </span>
									</a>
								</li>
							</ul>
							<div class="hamburger_container">
								<i class="fa fa-bars" aria-hidden="true"></i>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</header>
    <div class="fs_menu_overlay"></div>

	<!-- Hamburger Menu -->

	<div class="hamburger_menu">
		<div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
		<div class="hamburger_menu_content text-right">
			<ul class="menu_top_nav">
                <?php
                
                if(isset($_SESSION['user_name'])&&isset($_SESSION['user_id']))
                {
                    echo '<li class="menu_item has-children">
					<a href="#">
						'.$_SESSION['user_name'].'
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="menu_selection">
						<li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Log out</a></li>
					</ul>
				    </li>'; 
                }
                else
                {
                    echo '<li class="menu_item has-children">
					<a href="#">
						My Account
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="menu_selection">
						<li><a href="signin.php"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
						<li><a href="register.php"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
					</ul>
				    </li>';   
                }
                ?>
				<li class="menu_item"><a href="index.php">home</a></li>
				<li class="menu_item"><a href="categories.php">Categories</a></li>
				<li class="menu_item"><a href="contact.php">contact</a></li>
			</ul>
		</div>
	</div>    