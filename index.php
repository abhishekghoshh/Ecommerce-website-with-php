<?php 
include("includes/db.php");
include("includes/header.php");
?>

	<!-- Slider -->
	<div class="main_slider" style="background-image:url(https://assets.pcmag.com/media/images/559652-google-pixel-2.jpg?thumb=y)">
		<div class="container fill_height">
			<div class="row align-items-center fill_height">
				<div class="col">
					<div class="main_slider_content">
						<h1 style="color:#FFF;">New Arrival of 2018</h1>
						<div class="red_button shop_now_button"><a href="categories.php?sort=comming">shop now</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Banner -->
	<div class="banner">
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="banner_item align-items-center" style="background-image:url(//cdn.pocket-lint.com/r/s/970x/assets/images/140644-phones-review-samsung-galaxy-s8-review-image1-wyesoelc2u.jpg)">
						<div class="banner_category">
							<a href="categories.php?brand=Samsung">Samsung</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="banner_item align-items-center" style="background-image:url(https://techaeris.com/wp-content/uploads/2018/03/Honor-7X-FI.jpg)">
						<div class="banner_category">
							<a href="categories.php?brand=Honor">Honor</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="banner_item align-items-center" style="background-image:url(https://st1.bgr.in/wp-content/uploads/2014/09/xiaomi-redmi-1s-review.jpg)">
						<div class="banner_category">
							<a href="categories.php?brand=Mi">MI</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- New Arrivals -->
	<div class="new_arrivals">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
						<h2>New Arrivals</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
                        <!-- Newly arrived product -->
                        <?php
                        $rnd=mt_rand(0, 80);
                        $sql="Select * from phone where comming=1 limit 12 offset ".$rnd;
                        $result=query($sql);
                        while($row=mysqli_fetch_assoc($result))
                        {
                        $descript=explode("@",$row['description']);
                        $x=(int)(count($descript)/2);
                        $description=array();
                        for($i=0;$i<$x;$i=$i+2)
                        {$description[$descript[$i]]=$descript[$i+1];}

                        echo '
                        <div class="product-item">
                            <div class="product product_filter" >
                                <a href="item.php?id='.$row["id"].'">
                                    <div class="product_image product_info">
                                        <img src='.$row["img"].' alt="" style="height:250px;width:130px;">
                                    </div>
                                    <div class="product_info">
                                        <p class="product_name">'.$description['Model Name'].'</br>'.$description['Color'].'</p>
                                        <div class="product_price">'.$row["price"].'</div>
                                    </div>
                                </a>
                            </div>
                            <div class="red_button add_to_cart_button"  style="width:90%;left:5%;padding:0%;margin:0%;"><a href="checkout.php?id='.$row["id"].'">add to cart</a></div>
                        </div>';
                        }
                        ?>	
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Best Sellers -->
	<div class="best_sellers">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
						<h2>Best Sellers</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="product_slider_container">
						<div class="owl-carousel owl-theme product_slider">
                            <!-- Slide  -->
                            <?php
                            $rnd=mt_rand(0,10);
                            $sql="SELECT * FROM `phone` order by camera DESC limit 15 offset ".$rnd;
                            $result=query($sql);
                            while($row=mysqli_fetch_assoc($result))
                            {
                                 $descript=explode("@",$row['description']);
                                $x=(int)(count($descript)/2);
                                $description=array();
                                for($i=0;$i<$x;$i=$i+2)
                                {$description[$descript[$i]]=$descript[$i+1];}
                                echo '
                                <div class="owl-item product_slider_item">
                                <a href="item.php?id='.$row["id"].'">
                                <div class="product-item">
                                    <div class="product">
                                        <div class="product_image" style="left:20%">
                                            <img src='.$row["img"].' alt="" style="height:230px;width:120px;" align="middle">
                                        </div>
                                        <div class="product_info">
                                            <h6 class="product_name">'.$description['Model Name'].'</br>'.$description['Color'].'</h6>
                                            <div class="product_price">'.$row["price"].'</div>
                                        </div>
                                    </div>
                                </div>
                                </a>
                                 </div>';
                                }
                            ?>		
						</div>
                        <!-- Slider Navigation -->

						<div class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-left" aria-hidden="true"></i>
						</div>
						<div class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-right" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	

	<!-- Footer -->

	<?php include("includes/footer.php");