<?php 
include('includes/mainheader.php'); 
if(isset($_SESSION['alogin'],$_SESSION['alogged']) && (time() - $_SESSION['alogged'] > 5*60))
{
  session_unset(); // unset $_SESSION variable for the run-time
  session_destroy(); // destroy session data in storage
  echo '<script>alert("You have been idle for 5 minutes");</script>';
  echo '<script>window.location.replace("../logout.php");</script>';
}
else
{
  session_regenerate_id(true);
  $_SESSION['alogged'] = time();
}

if(isset($_POST['update']))
{
  $prodid=$_POST['productid'];
  $category=strtoupper($_POST['category']);
  $subcat=strtoupper($_POST['subcategory']);
  $productname=strtoupper($_POST['productName']);
  $productcompany=strtoupper($_POST['productCompany']);
  $productfinalprice=$_POST['productfinalprice'];
  $productpricebd=$_POST['productpricebd'];  
  $discountprice=$_POST['discountprice'];
  $discountpercent=$_POST['discountpercent'];
  $productdescription=strtoupper($_POST['productDescription']);
  $productscharge=$_POST['productShippingcharge'];
  $productavailability=strtoupper($_POST['productAvailability']);
  $sql="UPDATE products set parentcategoryid='$category',subcategoryid='$subcat',productName='$productname',productCompany='$productcompany',productFinalPrice='$productfinalprice',productDescription='$productdescription',shippingCharge='$productscharge',productAvailability='$productavailability',productPrice='$productpricebd',discountPercent='$discountpercent',discountPrice='$discountprice' where productid='$prodid'";
  $query = $dbh->prepare($sql);               
  if($query->execute())
  {
    $_SESSION['msg']="Product Updated Successfully!!";         
  }
  else
  {
    echo "<script>alert('Records could not be updated');</script>";
  }
}

?>

<body>

  <script>
    function getSubcat(val) 
    {
      $.ajax({
        type: "POST",
        url: "get-subcategory.php",
        data:'cat_id='+val,
        success: function(data){
          $("#subcategory").html(data);
        }
      });
    }

    function selectCountry(val) 
    {
      $("#search-box").val(val);
      $("#suggesstion-box").hide();
    }
  </script>

<?php include("includes/header.php");?>
  
  <div class="ts-main-content">

<?php 
    include('includes/sidebar.php');
?>
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">          
            <h2 class="page-title">Update Product</h2>
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">Update Product</div>
                    <div class="panel-body">
                      <?php 
                        if(isset($_POST['update']))
                        { 
                      ?>
                        <div class="alert alert-error" style="color: green;">
                          <button type="button" class="close" data-dismiss="alert">×</button>
                            <?php echo htmlentities($_SESSION['msg']); ?>
                            <?php echo htmlentities($_SESSION['msg']=""); ?>
                        </div>
                      <?php 
                        }
                      ?>

                      <form method="post" class="form-horizontal">

                        <div class="hr-dashed"></div>
                        <?php 
                          $id=$_GET['id'];
                          $sql="SELECT * from products where productid=:id";
                          $query = $dbh->prepare($sql);
                          $query->bindParam(':id',$id,PDO::PARAM_STR);
                          $query->execute();
                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                          if($query->rowCount() > 0)
                          {
                            foreach($results as $result)
                            {
                        ?>
                              <div class="form-group">
                                <div class="col-sm-6">
                                  <input type="text" name="productid" value="<?php echo $result->productid; ?>"hidden>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-5 control-label">Parent Category</label>
                                <div class="col-sm-6">
                                  <select name="category" class="form-control" onChange="getSubcat(this.value);" required>
                                    <?php 
                                      $pid=$result->parentcategoryid;
                                      $sql="SELECT * from category where categoryid=$pid";
                                      $query = $dbh->prepare($sql);
                                      $query->execute();
                                      $data=$query->fetchAll(PDO::FETCH_OBJ);
                                      if($query->rowCount() > 0)
                                      {
                                        foreach($data as $dt)
                                        {
                                    ?>
                                          <option value="<?php echo $dt->categoryid; ?>"><?php echo $dt->categoryName; ?></option>
                                    <?php
                                        }
                                      } 
                                      $sql="SELECT * from category";
                                      $query = $dbh->prepare($sql);
                                      $query->execute();
                                      $data=$query->fetchAll(PDO::FETCH_OBJ);
                                      if($query->rowCount() > 0)
                                      {
                                        foreach($data as $dt)
                                        {
                                    ?>
                                          <option value="<?php echo $dt->categoryid; ?>"><?php echo $dt->categoryName; ?></option>
                                    <?php
                                        }
                                      }
                                    ?>                        
                                  </select>
                                </div>
                              </div>
                                                
                              <div class="form-group">
                                <label class="col-sm-5 control-label">Sub Category</label>
                                <div class="col-sm-6">
                                  <select name="subcategory" id="subcategory" class="form-control" required>
                                    <?php 
                                      $sid=$result->subcategoryid;
                                      $sql="SELECT * from subcategory where subcategoryid=$sid";
                                      $query = $dbh->prepare($sql);
                                      $query->execute();
                                      $data=$query->fetchAll(PDO::FETCH_OBJ);
                                      if($query->rowCount() > 0)
                                      {
                                        foreach($data as $dt)
                                        {
                                    ?>
                                          <option value="<?php echo $dt->subcategoryid; ?>"><?php echo $dt->subcategoryName; ?></option>
                                    <?php
                                        }
                                      }
                                    ?>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-5 control-label">Product Name</label>
                                <div class="col-sm-6">
                                  <input type="text" name="productName" placeholder="Enter Product Name" value="<?php echo $result->productName; ?>" class="form-control" required>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-5 control-label">Product Company</label>
                                <div class="col-sm-6">
                                  <input type="text" name="productCompany" placeholder="Enter Product Comapny Name" value="<?php echo $result->productCompany; ?>" class="form-control" required>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-5 control-label">Product Price Before Discount</label>
                                <div class="col-sm-6">
                                  <input type="text" name="productpricebd" placeholder="Enter Product Price" value="<?php echo $result->productPrice; ?>" class="form-control" required>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-5 control-label">Product Final Price</label>
                                <div class="col-sm-6">
                                  <input type="text" name="productfinalprice" placeholder="Enter Product Price" value="<?php echo $result->productFinalPrice; ?>" class="form-control" required>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-5 control-label">Discount Percent</label>
                                <div class="col-sm-6">
                                  <input type="text" name="discountpercent" placeholder="Enter Discount Percent" value="<?php echo $result->discountPercent; ?>" class="form-control" required>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-5 control-label">Discount Price</label>
                                <div class="col-sm-6">
                                  <input type="text" name="discountprice" placeholder="Enter Discount Price" value="<?php echo $result->discountPrice; ?>" class="form-control" required>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-5 control-label">Product Description</label>
                                <div class="col-sm-6">
                                  <textarea name="productDescription" class="form-control"><?php echo $result->productDescription; ?></textarea>  
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-5 control-label">Product Shipping Charge</label>
                                <div class="col-sm-6">
                                  <input type="text" name="productShippingcharge" placeholder="Enter Product Shipping Charge" value="<?php echo $result->shippingCharge; ?>" class="form-control" required>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-5 control-label">Product Availability</label>
                                <div class="col-sm-6">
                                  <select name="productAvailability" id="productAvailability" class="form-control" required>
                                    <option value="<?php echo $result->productAvailability; ?>"><?php echo $result->productAvailability; ?></option>
                                    <option value="In Stock">In Stock</option>
                                    <option value="Out of Stock">Out of Stock</option>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-5 control-label">Product Image1</label>
                                <div class="col-sm-6">
                                  <img src="productimages/<?php echo htmlentities($id);?>/<?php echo htmlentities($result->productImage1);?>" width="200" height="100"><a href="update-image.php?id=<?php echo $result->productid; ?>&name=<?php echo $result->productImage1; ?>">Change Image</a>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-5 control-label">Product Image2</label>
                                <div class="col-sm-6">
                                  <img src="productimages/<?php echo htmlentities($id);?>/<?php echo htmlentities($result->productImage2);?>" width="200" height="100"><a href="update-image.php?id=<?php echo $result->productid; ?>&name=<?php echo $result->productImage2; ?>">Change Image</a>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-5 control-label">Product Image3</label>
                                <div class="col-sm-6">
                                  <img src="productimages/<?php echo htmlentities($id);?>/<?php echo htmlentities($result->productImage3);?>" width="200" height="100"><a href="update-image.php?id=<?php echo $result->productid; ?>&name=<?php echo $result->productImage3; ?>">Change Image</a>
                                </div>
                              </div>

                              <div class="col-sm-8 col-sm-offset-5">
                                <input class="btn btn-primary" type="submit" name="update" value="Update Product">
                              </div>
                        <?php
                            }
                          }
                        ?>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  
      </div>
    </div>
  </div>

<?php include('includes/footer.php'); ?>