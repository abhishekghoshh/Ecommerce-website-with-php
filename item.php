<?php
include("includes/db.php");
include("includes/header.php");

if(!isset($_SESSION['item_id']))
{$_SESSION['item_id']="";
}
if(isset($_GET['id']))
{
    $_SESSION['item_id']=$_GET['id'];
    $sql="select * from phone where id=".$_SESSION['item_id'];
    $result=query($sql);
    if(row_count($result)==0)
    {
        header("location: error.php");
    }
    else
    {
        $row=mysqli_fetch_assoc($result);
        $_SESSION['id']=$row['id'];
        $_SESSION['brand']=$row['brand'];
        $_SESSION['price']=$row['price'];
        $_SESSION['img']=$row['img'];
        $_SESSION['comming']=$row['comming'];
        
        $_SESSION['description']=explode("@",$row['description']);
        $descript=$_SESSION['description'];
        $x=(int)(count($descript)/2);
        $description=array();
        for($i=0;$i<$x;$i=$i+2)
        {$description[$descript[$i]]=$descript[$i+1];}
        
        $_SESSION['rating']=$row['rating'];
        $_SESSION['camera']=$row['camera'];
        $_SESSION['display']=$row['display'];
        $_SESSION['battery']=$row['battery'];
    }
}
else
{
    header("location: error.php");
}

?>



	<div class="container single_product_container">
		<div class="row">
			<div class="col">

				<!-- Breadcrumbs -->
				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="categories.php?brand=<?php echo $_SESSION['brand'];?>"><i class="fa fa-angle-right" aria-hidden="true"></i><?php echo $_SESSION['brand'];?></a></li>
                        <li class="active"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i><?php echo $description['Model Name'];?></a></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-7">
				<div class="single_product_pics">
					<div class="row">
						<div class="col-lg-3 thumbnails_col order-lg-1 order-2">
							<div class="single_product_thumbnails">
								<ul>
									<li><img src="<?php echo $_SESSION['img'];?>" style="max-width:55%;max-height:95%;" alt="" data-image="<?php echo $_SESSION['img'];?>"></li>
									<li class="active"><img src="<?php echo $_SESSION['img'];?>" style="max-width:55%;max-height:95%;"  alt="" data-image="<?php echo $_SESSION['img'];?>"></li>
									<li><img src="<?php echo $_SESSION['img'];?>" style="max-width:55%;max-height:95%;"  alt="" data-image="<?php echo $_SESSION['img'];?>"></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-9 image_col order-lg-2 order-1">
							<div class="single_product_image" >
								<div class="single_product_image_background" style="background-image:url(<?php echo $_SESSION['img'];?>);background-size:contain;" ></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="product_details">
					<div class="product_details_title">
						<h2><?php echo $description['Model Name']; ?></h2>
                        <h3><?php echo $description['Color']; ?></h3>
                        <h3 class="red_button"><?php if($_SESSION['comming']==1)
                                    { echo "Comming Soon";}?></h3>
						<p><?php
                            $x=0;
                            foreach($description as $key => $value)
                            {
                                echo $key.' : '.$value.'</br>';
                                $x=$x+1;
                                if($x==10)
                                {break;}
                            }
                            ?></p>
					
					<div class="free_delivery d-flex flex-row align-items-center justify-content-center">
						<span class="ti-truck"></span><span>free delivery</span>
					</div>

					<div class="product_price" style="top:20px;left:30%;"><?php echo 'Price : ₹' .$_SESSION['price']; ?></div>
                    <div class="red_button"style="width:95%;top:50px;left:13px;"><a href="checkout.php?id=<?php echo $row["id"]; ?>">add to cart</a></div>
                        </div>
				</div>
			</div>
		</div>

	</div>

	<!-- Tabs -->

	<div class="tabs_section_container">

		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabs_container">
						<ul class="tabs d-flex flex-sm-row flex-column align-items-left align-items-md-center justify-content-center">
							<li class="tab active" data-active-tab="tab_1"><span>Description</span></li>
							<li class="tab" data-active-tab="tab_2"><span>Additional Information</span></li>
							<li class="tab" data-active-tab="tab_3"><span>Reviews (2)</span></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">

					<!-- Tab Description -->

					<div id="tab_1" class="tab_container active">
                        <div class="tab_title">
									<h4>Description</h4>
								</div>
						<div class="row" style="top:-50px;">
							<div class="col-lg-5 desc_col">
								<div class="tab_text_block">
									<?php
                                    $x=(int)(count($description));
                                    $i=0;
                                    foreach($description as $key => $value)
                                    {
                                        $i=$i+1;
                                        if($i<=$x/2)
                                        {echo '<h6 style="display: inline-block;">'.$key.'</h6> : <p style="display: inline-block;">'.$value.'</p></br>';}
                                    }
                                    ?>
								</div>
							</div>
							<div class="col-lg-5 offset-lg-2 desc_col">
								<div class="tab_text_block">
									<?php
                                    $i=0;
                                    foreach($description as $key => $value)
                                    {
                                        $i=$i+1;
                                        if($i>$x/2)
                                        {echo '<h6 style="display: inline-block;">'.$key.'</h6> : <p style="display: inline-block;">'.$value.'</p></br>';} 
                                    }
                                    ?>
								</div>
								
							</div>
						</div>
					</div>

					<!-- Tab Additional Info -->

					<div id="tab_2" class="tab_container">
						<div class="row">
							<div class="col additional_info_col">
								<div class="tab_title additional_info_title">
									<h4>Additional Information</h4>
								</div>
								<p>Overall User Rating : <span><?php echo $_SESSION['rating'];?></span></p>
								<p>Camera Performance Rating : <span><?php echo $_SESSION['camera'];?></span></p>
                                <p>Display Performance Rating : <span><?php echo $_SESSION['display'];?></span></p>
                                <p>Battery Performance rating : <span><?php echo $_SESSION['battery'];?></span></p>
							</div>
						</div>
					</div>

					<!-- Tab Reviews -->

					<div id="tab_3" class="tab_container">
						<div class="row">

							<!-- User Reviews -->

							<div class="col-lg-6 reviews_col">
								<div class="tab_title reviews_title">
									<h4>Reviews (2)</h4>
								</div>

								<!-- User Review -->

								<div class="user_review_container d-flex flex-column flex-sm-row">
									<div class="user">
										<div class="user_pic"></div>
										<div class="user_rating">
											<ul class="star_rating">
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
											</ul>
										</div>
									</div>
									<div class="review">
										<div class="review_date">27 Aug 2016</div>
										<div class="user_name">Brandon William</div>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
									</div>
								</div>

								<!-- User Review -->

								<div class="user_review_container d-flex flex-column flex-sm-row">
									<div class="user">
										<div class="user_pic"></div>
										<div class="user_rating">
											<ul class="star_rating">
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
											</ul>
										</div>
									</div>
									<div class="review">
										<div class="review_date">27 Aug 2016</div>
										<div class="user_name">Brandon William</div>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
									</div>
								</div>
							</div>

							<!-- Add Review -->

							<div class="col-lg-6 add_review_col">

								<div class="add_review">
									<form id="review_form" action="post">
										<div>
											<h1>Add Review</h1>
											<input id="review_name" class="form_input input_name" type="text" name="name" placeholder="Name*" required="required" data-error="Name is required.">
											<input id="review_email" class="form_input input_email" type="email" name="email" placeholder="Email*" required="required" data-error="Valid email is required.">
										</div>
										<div>
											<h1>Your Rating:</h1>
											<ul class="user_star_rating">
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star" aria-hidden="true"></i></li>
												<li><i class="fa fa-star-o" aria-hidden="true"></i></li>
											</ul>
											<textarea id="review_message" class="input_review" name="message"  placeholder="Your Review" rows="4" required data-error="Please, leave us a review."></textarea>
										</div>
										<div class="text-left text-sm-right">
											<button id="review_submit" type="submit" class="red_button review_submit_btn trans_300" value="Submit">submit</button>
										</div>
									</form>
								</div>

							</div>

						</div>
					</div>

				</div>
			</div>
		</div>

	</div>

	<?php include("includes/item_footer.php"); ?>