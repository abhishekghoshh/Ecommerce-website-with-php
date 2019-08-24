<?php 
include("includes/db.php");
include("includes/header.php");

$brands=array();
$all_brands=query("Select distinct brand from phone");
while($row=mysqli_fetch_assoc($all_brands))
{array_push($brands,$row['brand']);}
if(isset($_GET['brand']))
{
    if($_GET['brand']!=''&&in_array($_GET['brand'],$brands))
    {  
        $_SESSION['brand']=$_GET['brand'];
        $brand_sql="where brand ='".$_SESSION['brand']."'";  
    }
    else
    {
        $_SESSION['brand']='';
        $brand_sql="";
    }
 }
else
{
    $_SESSION['brand']='';
    $brand_sql="";
}

if(isset($_GET['sort']))
{
    if(($_GET['sort']!='')&&($_GET['sort']=='price'||$_GET['sort']=='camera'||$_GET['sort']=='display'||$_GET['sort']=='battery'||$_GET['sort']=='comming'||$_GET['sort']=='rating'))
    {
        $_SESSION['sort']=$_GET['sort'];
    }
    else
    {
        $_SESSION['sort']="price";
    }
}
else
{
    $_SESSION['sort']="price";
}
$sort_sql="order by ".$_SESSION['sort']." desc";



?>

	<div class="fs_menu_overlay"></div>
	<div class="container product_section_container">
		<div class="row">
			<div class="col product_section clearfix">

				<!-- Breadcrumbs -->

				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li class="active"><i class="fa fa-angle-right" aria-hidden="true"></i><?php 
                                                                                        if($brand_sql!="")
                                                                                        {echo $_SESSION['brand'];}
                                                                                        else
                                                                                        {echo "All";}?></li>
					</ul>
				</div>

				<!-- Sidebar -->

				<div class="sidebar">
					<div class="sidebar_section">
						<div class="sidebar_title">
							<h5>Phone Category</h5>
						</div>
						<ul class="sidebar_categories">
                            <?php
                            $sql="select distinct brand from phone";
                            $result=query($sql);
                            while($row=mysqli_fetch_assoc($result))
                            {
                                echo '<li><a href="categories.php?brand='.$row['brand'].'&sort='.$_SESSION['sort'].'"</a>'.$row['brand'].'</li>';
                            }//make li class active
                            ?>
						</ul>
					</div>
				</div>

				<!-- Main Content -->

				<div class="main_content ">

					<!-- Products -->

					<div class="products_iso">
						<div class="row">
							<div class="col">

								<!-- Product Sorting -->
								<div class="product_sorting_container product_sorting_container_top">
									<ul class="product_sorting">
										<li>
											<span class="type_sorting_text"><?php echo $_SESSION['sort'];?></span>
											<i class="fa fa-angle-down"></i>
											<ul class="sorting_type">
                                                <li class="type_sorting_btn"><a href="categories.php?brand=<?php echo $_SESSION['brand'];?>&sort=price"><span>price</span></a></li>
                                                <li class="type_sorting_btn"><a href="categories.php?brand=<?php echo $_SESSION['brand'];?>&sort=comming"><span>comming</span></a></li>
                                                <li class="type_sorting_btn"><a href="categories.php?brand=<?php echo $_SESSION['brand'];?>&sort=rating"><span>rating</span></a></li>
                                                <li class="type_sorting_btn"><a href="categories.php?brand=<?php echo $_SESSION['brand'];?>&sort=camera"><span>camera</span></a></li>
                                                <li class="type_sorting_btn"><a href="categories.php?brand=<?php echo $_SESSION['brand'];?>&sort=display"><span>display</span></a></li>
                                                <li class="type_sorting_btn"><a href="categories.php?brand=<?php echo $_SESSION['brand'];?>&sort=battery"><span>battery</span></a></li>
											</ul>
										</li>
									</ul>
								</div>

								<!-- Product Grid -->

								<div class="product-grid">
									<!-- Product -->
                                    <?php
                                    $sql="select * from phone ".$brand_sql." ".$sort_sql;
                                    $result=query($sql);
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                        if($_SESSION['sort']=='comming'&&$row['comming']==0)
                                        {
                                            continue;
                                        }
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
                                    }?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<?php include("includes/categories_footer.php"); ?>