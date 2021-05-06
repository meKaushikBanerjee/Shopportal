<?php 
$page=0;
include("includes/main.php"); 
if(isset($_SESSION['alogin'],$_SESSION['alogged']) && (time() - $_SESSION['alogged'] > 60*60))
{
  session_unset(); // unset $_SESSION variable for the run-time
  session_destroy(); // destroy session data in storage
  header('Location: logout.php');
}
else
{
  session_regenerate_id(true);
  $_SESSION['alogged'] = time();
}
if(isset($_SESSION['logout']))
{
	if($_SESSION['logout'] == 1)
	{
		include("includes/topheader.php");
	}
}
include("includes/searchbar.php");
include("includes/navbar.php"); 

//whether ip is from share internet
if (!empty($_SERVER['HTTP_CLIENT_IP']))   
{
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
}
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
{
	$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
//whether ip is from remote address
else
{
    $ip_address = $_SERVER['REMOTE_ADDR'];
}

include("includes/offer-banner.php");
?>

<div class="cat-product-container">
	<div class="row">

<?php
	$sql="SELECT * from products where parentcategoryid='4'";
	$query = $dbh->prepare($sql);
	$query->bindParam(':pcatid',$pcatid,PDO::PARAM_STR);		
	$query->bindParam(':subcatid',$subcatid,PDO::PARAM_STR);	
	$query->execute();	
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	if($query->rowCount() > 0)
	{
		foreach($results as $result)
		{
?>	
			<div class="col-md-3 col-sm-6">
				<div class="cat-product-grid4">
				    <div class="cat-product-image4">
				        <a href="#">
				            <img class="cat-pic-1" src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage1; ?>">
				            <img class="cat-pic-2" src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage2; ?>">
				        </a>
				        <ul class="cat-social">
				            <li><a href="#" data-tip="Quick View"><i class="fa fa-eye"></i></a></li>
				            <li><a href="#" data-tip="Add to Wishlist"><i class="fa fa-shopping-bag"></i></a></li>
				            <li><a href="#" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
				        </ul>
				       	<span class="cat-product-new-label">New</span>
				        <span class="cat-product-discount-label">-10%</span>
				    </div>
				    <div class="cat-product-content">
				        <h3 class="cat-title"><a href="product-detail.php?product=<?php echo $result->productid; ?>&pcat=<?php echo $result->parentcategoryid; ?>&scat=<?php echo $result->subcategoryid; ?>"><?php echo $result->productName; ?></a></h3>
				        <div class="cat-price"><?php echo $result->productFinalPrice; ?></div>
				        <a class="cat-add-to-cart" href="">ADD TO CART</a>
				    </div>
				</div>
			</div>
<?php
		}
	}
?>	
	</div>
	<div class="hr-dashed"></div>
</div>


            <div id="desktop-display">
              <div class="row">
                <div class="col-md-12">
                  <h2>Trending <b>Products</b></h2>
                  <div id="product-carousel" class="carousel slide" data-ride="carousel" data-interval="0">
                    <!-- Wrapper for carousel items -->
                    <div class="carousel-inner">
<?php
    $sql="SELECT * from products where parentcategoryid='4' and subcategoryid='4'";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
      $i=1;
      $c=1;
      $count=$query->rowCount();
      foreach($results as $result)
      {

        if($i==1)
        {
?>
                        <div class="item carousel-item active">
                          <div class="row">
                            <div class="col-sm-4">
                              <div class="slider-product-card">
                                <div class="thumb-wrapper">
                                  <div class="img-box">
                                    <img src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage1; ?>" class="img-responsive img-fluid" alt="">
                                  </div>
                                  <div class="thumb-content">
                                    <a href="product-detail.php?product=<?php echo $result->productid; ?>&pcat=<?php echo $result->parentcategoryid; ?>&scat=<?php echo $result->subcategoryid; ?>"><h4><?php echo $result->productName; ?></h4></a>
                                    <p class="item-price"><?php echo $result->productFinalPrice ?></p>
                                    <div class="star-rating">
                                      <ul class="list-inline">
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                      </ul>
                                    </div>
                                    <a href="#" class="btn btn-primary">Add to Cart</a>
                                  </div>            
                                </div>
                              </div>
                            </div>
<?php
                      if($c==$count)
                      {
?>
                          </div>
                        </div>
<?php
                      }
                      ++$i;++$c;
        }
        elseif($i==2)
        {
?>
                            <div class="col-sm-4">
                              <div class="slider-product-card">
                                <div class="thumb-wrapper">
                                  <div class="img-box">
                                    <img src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage1; ?>" class="img-responsive img-fluid" alt="">
                                  </div>
                                  <div class="thumb-content">
                                    <a href="product-detail.php?product=<?php echo $result->productid; ?>&pcat=<?php echo $result->parentcategoryid; ?>&scat=<?php echo $result->subcategoryid; ?>"><h4><?php echo $result->productName; ?></h4></a>
                                    <p class="item-price"><span><?php echo $result->productPrice ?></span></p>
                                    <div class="star-rating">
                                      <ul class="list-inline">
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                      </ul>
                                    </div>
                                    <a href="#" class="btn btn-primary">Add to Cart</a>
                                  </div>            
                                </div>
                              </div>
                            </div>
<?php
                      if($c==$count)
                      {
?>
                          </div>
                        </div>
<?php
                      }
                      ++$i;++$c;
        }
        elseif($i==3)
        {
?>
                            <div class="col-sm-4">
                              <div class="slider-product-card">
                                <div class="thumb-wrapper">
                                  <div class="img-box">
                                    <img src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage1; ?>" class="img-responsive img-fluid" alt="">
                                  </div>
                                  <div class="thumb-content">
                                    <a href="product-detail.php?product=<?php echo $result->productid; ?>&pcat=<?php echo $result->parentcategoryid; ?>&scat=<?php echo $result->subcategoryid; ?>"><h4><?php echo $result->productName; ?></h4></a>
                                    <p class="item-price"><span><?php echo $result->productPrice ?></span></p>
                                    <div class="star-rating">
                                      <ul class="list-inline">
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                      </ul>
                                    </div>
                                    <a href="#" class="btn btn-primary">Add to Cart</a>
                                  </div>            
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
<?php
                      ++$i;++$c;
        }
        elseif($i==4)
        {
?>
                        <div class="item carousel-item">
                          <div class="row">
                            <div class="col-sm-4">
                              <div class="slider-product-card">
                                <div class="thumb-wrapper">
                                  <div class="img-box">
                                    <img src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage1; ?>" class="img-responsive img-fluid" alt="">
                                  </div>
                                  <div class="thumb-content">
                                    <a href="product-detail.php?product=<?php echo $result->productid; ?>&pcat=<?php echo $result->parentcategoryid; ?>&scat=<?php echo $result->subcategoryid; ?>"><h4><?php echo $result->productName; ?></h4></a>
                                    <p class="item-price"><span><?php echo $result->productPrice ?></span></p>
                                    <div class="star-rating">
                                      <ul class="list-inline">
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                      </ul>
                                    </div>
                                    <a href="#" class="btn btn-primary">Add to Cart</a>
                                  </div>            
                                </div>
                              </div>
                            </div>
<?php
                      if($c==$count)
                      {
?>
                          </div>
                        </div>
<?php
                      }
                      ++$i;++$c;
        }
        elseif($i==5)
        {
?>
                            <div class="col-sm-4">
                              <div class="slider-product-card">
                                <div class="thumb-wrapper">
                                  <div class="img-box">
                                    <img src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage1; ?>" class="img-responsive img-fluid" alt="">
                                  </div>
                                  <div class="thumb-content">
                                    <a href="product-detail.php?product=<?php echo $result->productid; ?>&pcat=<?php echo $result->parentcategoryid; ?>&scat=<?php echo $result->subcategoryid; ?>"><h4><?php echo $result->productName; ?></h4></a>
                                    <p class="item-price"><span><?php echo $result->productPrice ?></span></p>
                                    <div class="star-rating">
                                      <ul class="list-inline">
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                      </ul>
                                    </div>
                                    <a href="#" class="btn btn-primary">Add to Cart</a>
                                  </div>            
                                </div>
                              </div>
                            </div>
<?php
                      if($c==$count)
                      {
?>
                          </div>
                        </div>
<?php
                      }
                      ++$i;++$c;
        }
        elseif($i==6)
        {
?>
                            <div class="col-sm-4">
                              <div class="slider-product-card">
                                <div class="thumb-wrapper">
                                  <div class="img-box">
                                    <img src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage1; ?>" class="img-responsive img-fluid" alt="">
                                  </div>
                                  <div class="thumb-content">
                                    <a href="product-detail.php?product=<?php echo $result->productid; ?>&pcat=<?php echo $result->parentcategoryid; ?>&scat=<?php echo $result->subcategoryid; ?>"><h4><?php echo $result->productName; ?></h4></a>
                                    <p class="item-price"><span><?php echo $result->productPrice ?></span></p>
                                    <div class="star-rating">
                                      <ul class="list-inline">
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                        <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                      </ul>
                                    </div>
                                    <a href="#" class="btn btn-primary">Add to Cart</a>
                                  </div>            
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
<?php
                      $i=4;++$c;
        }
      }
    }
?>
                    </div>                    
                    <!-- Carousel controls -->
                    <a class="carousel-control left carousel-control-prev" href="#product-carousel" data-slide="prev">
                      <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="carousel-control right carousel-control-next" href="#product-carousel" data-slide="next">
                      <i class="fa fa-angle-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <div id="mobile-display">
              <div id="mobile-product-carousel" class="carousel slide" data-ride="carousel" data-interval="0">
                <div class="container">
                  <h2>Trending <b>Products</b></h2>
                  <div class="carousel-inner">

<?php
    $sql="SELECT * from products where parentcategoryid='4' and subcategoryid='4'";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
      $i=1;
      foreach($results as $result)
      {

        if($i==1)
        {
?>
                    <div class="carousel-item active">
                      <div class="slider-product-card">
                        <div class="thumb-wrapper">
                          <div class="img-box">
                            <img src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage1; ?>" class="img-responsive img-fluid" alt="">
                          </div>
                          <div class="thumb-content">
                            <a href="product-detail.php?product=<?php echo $result->productid; ?>&pcat=<?php echo $result->parentcategoryid; ?>&scat=<?php echo $result->subcategoryid; ?>"><h4><?php echo $result->productName; ?></h4></a>
                            <p class="item-price"><?php echo $result->productFinalPrice ?></p>
                            <div class="star-rating">
                              <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                              </ul>
                            </div>
                            <a href="#" class="btn btn-primary">Add to Cart</a>
                          </div>            
                        </div>
                      </div>
                    </div>
<?php
                ++$i;
        }
        else
        {
?>
                    <div class="carousel-item">
                      <div class="slider-product-card">
                        <div class="thumb-wrapper">
                          <div class="img-box">
                            <img src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage1; ?>" class="img-responsive img-fluid" alt="">
                          </div>
                          <div class="thumb-content">
                            <a href="product-detail.php?product=<?php echo $result->productid; ?>&pcat=<?php echo $result->parentcategoryid; ?>&scat=<?php echo $result->subcategoryid; ?>"><h4><?php echo $result->productName; ?></h4></a>
                            <p class="item-price"><?php echo $result->productFinalPrice ?></p>
                            <div class="star-rating">
                              <ul class="list-inline">
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                              </ul>
                            </div>
                            <a href="#" class="btn btn-primary">Add to Cart</a>
                          </div>            
                        </div>
                      </div>
                    </div>
<?php
        }
      }
    }
?>
                  </div>
                </div>
                <a class="carousel-control left carousel-control-prev" href="#mobile-product-carousel" data-slide="prev">
                  <i class="fa fa-angle-left"></i>
                </a>
                <a class="carousel-control right carousel-control-next" href="#mobile-product-carousel" data-slide="next">
                  <i class="fa fa-angle-right"></i>
                </a> 
              </div>
            </div>
            <div class="hr-dashed"></div>
<?php

	/*else 
	{
		echo '<script>window.location.replace("/")</script>';
	}*/
?>

<?php include ("includes/footer.php"); ?>