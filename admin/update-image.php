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
  $productname=$_POST['productName'];
  $productimage=$_FILES["productimage"]["name"];
  //$dir="productimages";
  //unlink($dir.'/'.$pimage);
  move_uploaded_file($_FILES["productimage"]["tmp_name"],"productimages/$id/".$_FILES["productimage"]["name"]);

  if($img==1)
  {
    $sql="UPDATE products set productImage1=:productimage where productid=:id";
  }
  elseif($img==2)
  {
    $sql="UPDATE products set productImage2=:productimage where productid=:id";
  }
  elseif($img==3)
  {
    $sql="UPDATE products set productImage3=:productimage where productid=:id";
  }
  $query = $dbh->prepare($sql);
  $query->bindParam(':productimage',$productimage,PDO::PARAM_STR); 
  if($query->execute())
  {
    $_SESSION['msg']="Image Updated Successfully!!";         
  }
  else
  {
    echo "<script>alert('Records could not be updated');</script>";
  }
}

?>

<body>

<?php include("includes/header.php");?>
  
  <div class="ts-main-content">

<?php 
    include('includes/sidebar.php');
?>
    <div class="content-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">          
            <h2 class="page-title">Update Category</h2>
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">Update Category</div>
                    <div class="panel-body">
                      <?php 
                        if(isset($_POST['update']))
                        { 
                      ?>
                        <p style="color: green;">
                          <?php echo htmlentities($_SESSION['msg']); ?>
                          <?php echo htmlentities($_SESSION['msg']=""); ?>
                        </p>
                      <?php 
                        }
                      ?>

                      <form method="post" class="form-horizontal">

                        <div class="hr-dashed"></div>
                        <?php 
                          $id=$_GET['id'];
                          $imgname=$_GET['name'];
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
                                <label class="col-sm-2 control-label" for="basicinput">Product Name</label>
                                <div class="col-sm-8">
                                  <input type="text" name="productName" readonly value="<?php echo htmlentities($result->productName);?>" class="form-control" required>
                                </div>
                              </div>

                              <div class="form-group">
                                <label class="col-sm-2 control-label" for="basicinput">Current Product Image</label>
                                <div class="col-sm-8">
                                  <img src="productimages/<?php echo htmlentities($id);?>/<?php echo $imgname; ?>" width="200" height="100"> 
                                </div>
                              </div>

                              <?php
                                if($result->productImage1 == $imgname)
                                {
                                  $img=1;
                                }
                                elseif($result->productImage2 == $imgname)
                                {
                                  $img=2;
                                }
                                elseif($result->productImage3 == $imgname)
                                {
                                  $img=3;
                                }
                              ?>

                              <div class="form-group">
                                <label class="col-sm-2 control-label" for="basicinput">New Product Image</label>
                                <div class="col-sm-8">
                                  <input type="file" name="productimage" id="productimage" value="" class="form-control" required>
                                </div>
                              </div>

                              <div class="col-sm-8 col-sm-offset-2">
                                <input class="btn btn-primary" type="submit" name="update" value="Update Image">
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