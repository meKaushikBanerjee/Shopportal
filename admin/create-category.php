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
  $sql="SELECT * from category";
  $query = $dbh->prepare($sql);
  $query->execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  $row=$query->rowCount();
  if($row>=0)
  {
    $row += 1;
    $id="CAT_1".$row;
  }
  $catname=strtoupper($_POST['catname']);
  $des=strtoupper($_POST['desc']);
  $sql="INSERT INTO category(categoryid,categoryName,categoryDescription) VALUES(:id,:catname,:des)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':catname',$catname,PDO::PARAM_STR);
  $query->bindParam(':id',$id,PDO::PARAM_STR);
  $query->bindParam(':des',$des,PDO::PARAM_STR);               
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
  $sql="DELETE from category where categoryid=:id";
  $query = $dbh->prepare($sql);
  $query->bindParam(':id',$id,PDO::PARAM_STR);              
  if($query->execute())
  {    
    $_SESSION['delmsg']="Category Deleted Successfully!!";
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
            <h2 class="page-title">Create Category</h2>
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-primary">
                  <div class="panel-heading">Create Category</div>
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

                      <form method="post" class="form-horizontal" action="">                 
                        <div class="hr-dashed"></div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Category Name</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="catname" id="catname" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Description</label>
                          <div class="col-sm-8">
                            <textarea class="form-control" name="desc" id="desc" required></textarea>
                          </div>
                        </div>
                        <div class="col-sm-8 col-sm-offset-5">
                          <input class="btn btn-primary" type="submit" name="create" value="Create Category">
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
            <h2 class="page-title">Manage Categories</h2>
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
                    <th scope="col">Category Id</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Desription</th>
                    <th scope="col">Creation Date</th>
                    <th scope="col">Updation Date</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
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
                        <tr>
                          <th scope="row"><?php echo $result->categoryid; ?></th>
                          <td><?php echo $result->categoryName; ?></td>
                          <td><?php echo $result->categoryDescription; ?></td>
                          <td><?php echo $result->creationDate; ?></td>
                          <td><?php echo $result->updationDate; ?></td>
                          <td><a href="edit-category.php?id=<?php echo $result->categoryid;?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                            <a href="create-category.php?del=<?php echo $result->categoryid;?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>
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