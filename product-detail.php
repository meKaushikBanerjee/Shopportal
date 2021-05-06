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

	include("includes/searchbar.php");
	include("includes/navbar.php");

	if((isset($_GET['product']))&&(isset($_GET['pcat']))&&(isset($_GET['scat'])))
	{		
    if(isset($_SESSION['uid']))
    {
      $userid=strtoupper($_SESSION['uid']);
    }
    else
    {
      $userid=0;
    }
		$prodid=$_GET['product'];
    $pcatid=$_GET['pcat'];
    $subcatid=$_GET['scat'];
    $_SESSION['prodid']=$prodid;
    $_SESSION['pcatid']=$pcatid;
    $_SESSION['subcatid']=$subcatid;
    $sql="SELECT c.categoryid as cid,c.categoryName as cn,sc.subcategoryid as scid,sc.parentcategoryid as pcid,sc.subcategoryName as scn from category c join subcategory sc on c.categoryid=sc.parentcategoryid where c.categoryid='$pcatid' and sc.parentcategoryid='$pcatid' and sc.subcategoryid='$subcatid'";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
      foreach($results as $res)
      {
        $mysql="SELECT * from products where parentcategoryid=:pcatid and subcategoryid=:subcatid and productid=:prodid";
        /*$mysql="SELECT * from products prod join productreviews prodrev where prod.productid=prodrev.productid and prod.parentcategoryid=:pcatid and prod.subcategoryid=:subcatid and prod.productid=:prodid and prodrev.productid=:prodid";*/
        $query = $dbh->prepare($mysql);
        $query->bindParam(':prodid',$prodid,PDO::PARAM_STR);  
        $query->bindParam(':pcatid',$pcatid,PDO::PARAM_STR);
        $query->bindParam(':subcatid',$subcatid,PDO::PARAM_STR);  
        $query->execute();  
        $data=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
        {
          foreach($data as $result)
          {
?>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href=""><?php echo $res->cn; ?></a></li>
              <li class="breadcrumb-item"><a href=""><?php echo $res->scn ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo $result->productName; ?></li>
              <li class="breadcrumb-item"><a href="category.php?pcat=<?php echo $pcatid; ?>&scat=<?php echo $subcatid; ?>">Back to previous list</a></li>
            </ol>
            <script type="text/javascript">
              var uid=<?php echo $userid; ?>;
              function add_product(val) 
              {
                if(uid!=0)
                {
                  var request = new XMLHttpRequest();
                  request.onreadystatechange = function() {
                    if(this.readyState === 4 && this.status === 200){                    
                      alert("Product added to cart successfully!");
                      location.reload(); 
                    }
                    if(this.readyState === 4 && this.status === 204){
                      alert("Product could not be added to cart!");
                      location.reload(); 
                    }
                  };
                  request.open("GET", "add-to-cart.php?product_id="+val , true);
                  request.send();
                }
                else
                {
                  alert("Kindly login first!");
                  location.replace("login-signup.php");
                }
              }
              function wishlist_product(val) 
              {
                if(uid!=0)
                {
                  var request = new XMLHttpRequest();
                  request.onreadystatechange = function() {
                    if(this.readyState === 4 && this.status === 200){                    
                      alert("Product added to wishlist successfully!");
                      location.reload(); 
                    }
                    if(this.readyState === 4 && this.status === 204){
                      alert("Product could not be added to wishlist!");
                      location.reload(); 
                    }
                  };
                  request.open("GET", "add-to-wishlist.php?product_id="+val , true);
                  request.send();
                }
                else
                {
                  alert("Kindly login first!");
                  location.replace("login-signup.php");
                }
              }
            </script>

            <div class="container">
              <div class="card">
                <div class="container-fliud">
                  <div class="wrapper row">
                    <div class="preview col-md-6">
                      <div class="preview-pic tab-content">
                        <div class="tab-pane active" id="pic-1"><img src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage1; ?>" /></div>
                        <div class="tab-pane" id="pic-2"><img src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage2; ?>" /></div>
                        <div class="tab-pane" id="pic-3"><img src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage3; ?>" /></div>
                      </div>
                      <ul class="preview-thumbnail nav nav-tabs">
                        <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage1; ?>" /></a></li>
                        <li><a data-target="#pic-2" data-toggle="tab"><img src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage2; ?>" /></a></li>
                        <li><a data-target="#pic-3" data-toggle="tab"><img src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage3; ?>" /></a></li>
                      </ul>            
                    </div>
                    <div class="details col-md-6">
                      <h3 class="product-title"><?php echo $result->productName; ?></h3>
                      <div class="rating">
                        <div class="stars">
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star"></span>
                          <span class="fa fa-star"></span>
                        </div>
                        <span class="review-no">41 reviews</span>
                      </div>
                      <p class="product-description"><?php echo $result->productDescription; ?></p>
                      <h4 class="price">current price: <span><?php echo $result->productPrice; ?></span></h4>
                      <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
                      <h5 class="sizes">sizes: 
                        <span class="size" data-toggle="tooltip" title="small">s</span>
                        <span class="size" data-toggle="tooltip" title="medium">m</span>
                        <span class="size" data-toggle="tooltip" title="large">l</span>
                        <span class="size" data-toggle="tooltip" title="xtra large">xl</span>
                      </h5>
                      <h5 class="colors">colors:
                        <span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
                        <span class="color green"></span>
                        <span class="color blue"></span>
                      </h5>
                      <div class="action">
                        <button class="add-to-cart btn btn-default" type="button" onclick="add_product('<?php echo $prodid;?>');">add to cart</button>
                        <button class="like btn btn-default" type="button" onclick="wishlist_product('<?php echo $prodid;?>');"><span class="fa fa-heart"></span></button>
                      </div>
                    </div> 
                  </div>
                </div>
              </div>        
              <div class="hr-dashed"></div>
            </div> 
<?php
          }
        }
      }
    }
?>
            <div id="desktop-display">
              
<?php
    $sql="SELECT * from products where parentcategoryid='$pcatid' and subcategoryid='$subcatid' and productid<>'$prodid'";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
      $i=1;
      $c=1;
?>
              <div class="row">
                <div class="col-md-12">
                  <h2>Trending <b>Products</b></h2>
                  <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
                    <!-- Wrapper for carousel items -->
                    <div class="carousel-inner">
<?php
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
                    <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
                      <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
                      <i class="fa fa-angle-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <div id="mobile-display">
<?php
    $sql="SELECT * from products where parentcategoryid='$pcatid' and subcategoryid='$subcatid' and productid<>'$prodid'";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
      $i=1;
?>
              <div id="mobile-product-carousel" class="carousel slide" data-ride="carousel" data-interval="0">
                <div class="container">                  
                  <h2>Trending <b>Products</b></h2>
                  <div class="carousel-inner">
<?php
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
	}
  else
  {
    echo '<script>window.location.replace("/");</script>';
  }
?>

<?php include ("includes/footer.php"); ?>