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

if(isset($_POST['create']))
{
  $sql="SELECT * from products";
  $query = $dbh->prepare($sql);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  $row=$query->rowCount();
  if($row>=0)
  {
    $row += 1;
    $id="PROD_1".$row;
  }
  $dir="productimages/$id";
  if(!is_dir($dir))
  {
      mkdir("productimages/".$id);
  }

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
  $productimage1=$_FILES["productimage1"]["name"];
  $productimage2=$_FILES["productimage2"]["name"];
  $productimage3=$_FILES["productimage3"]["name"];

  move_uploaded_file($_FILES["productimage1"]["tmp_name"],"productimages/$productid/".$_FILES["productimage1"]["name"]);
  move_uploaded_file($_FILES["productimage2"]["tmp_name"],"productimages/$productid/".$_FILES["productimage2"]["name"]);
  move_uploaded_file($_FILES["productimage3"]["tmp_name"],"productimages/$productid/".$_FILES["productimage3"]["name"]);

  $sql="INSERT into products(productid,parentcategoryid,subcategoryid,productName,productCompany,productPrice,productDescription,shippingCharge,productAvailability,productImage1,productImage2,productImage3,productFinalPrice,discountPercent,discountPrice) values('$id','$category','$subcat','$productname','$productcompany','$productpricebd','$productdescription','$productscharge','$productavailability','$productimage1','$productimage2','$productimage3','$productfinalprice','$discountpercent','$discountprice')";
  $query = $dbh->prepare($sql);              
  if($query->execute())
  {
    $_SESSION['msg']="Category Created Successfully!!";         
  }
  else
  {
    echo "<script>alert('Records could not be updated');</script>";
  }
}

if(isset($_GET['del']))
{
  $id=$_GET['del'];
  $sql="DELETE from products where productid=:id";
  $query = $dbh->prepare($sql);
  $query->bindParam(':id',$id,PDO::PARAM_STR);              
  if($query->execute())
  {    
    $_SESSION['delmsg']="Category Deleted Successfully!!";
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
  </script>

<?php include("includes/header.php");?>
  
  <div class="ts-main-content">

<?php include('includes/sidebar.php'); ?>

    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">          
            <h2 class="page-title">Add Product</h2>
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">Add Product</div>
                    <div class="panel-body">
                      <?php 
                        if(isset($_POST['submit']))
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

                      <form class="form-horizontal row-fluid" name="insertproduct" method="post" action="" enctype="multipart/form-data">
                        <div class="hr-dashed"></div>
                        <div class="form-group">
                          <label class="col-sm-5  control-label">Parent Category</label>
                          <div class="col-sm-6">
                            <select name="category" class="form-control" onChange="getSubcat(this.value);" required>
                              <option value="">Select Parent Category</option>
                              <?php 
                                $sql="SELECT * from category";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                if($query->rowCount() > 0)
                                {
                                  foreach($results as $result)
                                  {
                              ?>
                                    <option value="<?php echo $result->categoryid; ?>"><?php echo $result->categoryName; ?></option>
                              <?php
                                  }
                                }
                              ?>                        
                            </select>
                          </div>
                        </div>
                                          
                        <div class="form-group">
                          <label class="col-sm-5  control-label">Sub Category</label>
                          <div class="col-sm-6">
                            <select name="subcategory" id="subcategory" class="form-control" required>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-5  control-label">Product Name</label>
                          <div class="col-sm-6">
                            <input type="text" name="productName" placeholder="Enter Product Name" class="form-control" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-5  control-label">Product Company</label>
                          <div class="col-sm-6">
                            <input type="text" name="productCompany" placeholder="Enter Product Comapny Name" class="form-control" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-5  control-label">Product Price Before Discount</label>
                          <div class="col-sm-6">
                            <input type="text" name="productpricebd" placeholder="Enter Product Price" class="form-control" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-5  control-label">Discount Percent</label>
                          <div class="col-sm-6">
                            <input type="text" name="discountpercent" placeholder="Enter Discount Percent" class="form-control" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-5  control-label">Discount Price</label>
                          <div class="col-sm-6">
                            <input type="text" name="discountprice" placeholder="Enter Discount Price" class="form-control" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-5  control-label">Product Final Price</label>
                          <div class="col-sm-6">
                            <input type="text" name="productfinalprice" placeholder="Enter Product Final Price" class="form-control" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-5  control-label">Product Description</label>
                          <div class="col-sm-6">
                            <textarea name="productDescription" placeholder="Enter Product Description" rows="6" class="form-control">
                            </textarea>  
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-5  control-label">Product Shipping Charge</label>
                          <div class="col-sm-6">
                            <input type="text" name="productShippingcharge" placeholder="Enter Product Shipping Charge" class="form-control" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-5  control-label">Product Availability</label>
                          <div class="col-sm-6">
                            <select name="productAvailability" id="productAvailability" class="form-control" required>
                              <option value="">Select</option>
                              <option value="In Stock">In Stock</option>
                              <option value="Out of Stock">Out of Stock</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-5  control-label">Product Image1</label>
                          <div class="col-sm-6">
                            <input type="file" name="productimage1" id="productimage1" value="" class="form-control" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-5  control-label">Product Image2</label>
                          <div class="col-sm-6">
                            <input type="file" name="productimage2"  class="form-control" required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-5  control-label">Product Image3</label>
                          <div class="col-sm-6">
                            <input type="file" name="productimage3"  class="form-control" required>
                          </div>
                        </div>

                        <div class="col-sm-8 col-sm-offset-5">
                          <input class="btn btn-primary" type="submit" name="create" value="Add Product">
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
    </div>
  </div>
  <div class="ts-main-content">
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h2 class="page-title">Manage Products</h2>
            <div class="table-responsive">
            <?php 
              if(isset($_GET['del']))
              {
            ?>
                <div class="alert alert-error" style="color: red;">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <?php echo htmlentities($_SESSION['delmsg']); ?>
                  <?php echo htmlentities($_SESSION['delmsg']=""); ?>
                </div>
            <?php 
              } 
            ?>
              <table id="zctb" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th scope="col">Product Id</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Parent Category</th>
                    <th scope="col">Sub-Category</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">Product Creation Date</th>
                    <th scope="col">Product Updation Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $sql="SELECT * from products";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $result)
                      {
                  ?>
                        <tr>
                          <th scope="row"><?php echo $result->productid; ?></th>
                          <td><?php echo $result->productName; ?></td>
                          <td><?php echo $result->parentcategoryid; ?></td>
                          <td><?php echo $result->subcategoryid; ?></td>
                          <td><?php echo $result->productCompany; ?></td>
                          <td><?php echo $result->creationDate; ?></td>
                          <td><?php echo $result->updationDate; ?></td>
                          <td><a href="edit-product.php?id=<?php echo $result->productid;?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                            <a href="add-product.php?del=<?php echo $result->productid;?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>
                        </tr>
                  <?php
                      }
                    } 
                  ?>                                      
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include('includes/footer.php'); ?>