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
  if($_POST['subcatname'])
  {
    $subcatname=strtoupper($_POST['subcatname']);
  }
  if($_POST['pcatname'])
  {
    $pcatid=strtoupper($_POST['pcatname']);
    $sql="SELECT categoryName from category where categoryid=:pcatname";
    $query = $dbh->prepare($sql);
    $query->bindParam(':pcatname',$pcatname,PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
      foreach($results as $result)
      {
        $pcatname=$result->categoryName;
      }
    }
  }
  date_default_timezone_set("Asia/Kolkata");
  $udate=date("d/m/y H:i:s");
  if($subcatname && $pcatid && $pcatname == " ")
  {
    $_SESSION['msg']="No Updations!!";
  }
  else
  {
    $sql="UPDATE subcategory set subcategoryName=:subcatname,parentcategoryid=:pcatid,parentcategoryName=:pcatname,updationDate=:udate where subcategoryid=:id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':subcatname',$subcatname,PDO::PARAM_STR);
    $query->bindParam(':id',$id,PDO::PARAM_STR);
    $query->bindParam(':pcatname',$pcatname,PDO::PARAM_STR);
    $query->bindParam(':pcatid',$pcatid,PDO::PARAM_STR);
    $query->bindParam(':udate',$udate,PDO::PARAM_STR);               
    if($query->execute())
    {
      $_SESSION['msg']="Sub-Category Updated Successfully!!";         
    }
    else
    {
      echo "<script>alert('Records could not be updated');</script>";
    }
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
            <h2 class="page-title">Update Sub-Category</h2>
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">Update Sub-Category</div>
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
                          $sql="SELECT * from subcategory where subcategoryid=:id";
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
                                <label class="col-sm-2 control-label">Sub-Category Id</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" name="id" id="id" value="<?php echo $result->subcategoryid; ?>" readonly>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Sub-Category Name</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" name="subcatname" id="subcatname" value="<?php echo $result->subcategoryName; ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Select Parent Category</label>
                                <div class="col-sm-8">
                                  <Select name="pcatname" class="form-control">
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
                              <div class="col-sm-8 col-sm-offset-2">
                                <input class="btn btn-primary" type="submit" name="update" value="Update Sub-Category">
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