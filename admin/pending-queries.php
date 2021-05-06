<?php 
include('includes/mainheader.php');
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
            <h2 class="page-title">Pending Orders</h2>
            <div class="table-responsive">
              <table id="zctb" class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th scope="col">Enquiry Id</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Customer Email</th>
                    <th scope="col">Customer Mobile</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Message</th>
                    <th scope="col">Enquiry Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $sql="SELECT * from enquiry where orderStatus=0";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $result)
                      {
                        $pid=unserialize($result->productid);
                        $pname=unserialize($result->productName);
                        $pquant=unserialize($result->quantity);
                        $i=0;
                  ?>
                        <tr>
                          <th scope="row"><?php echo $result->orderid; ?></th>
                          <td><?php echo $result->userid; ?></td>
                          <td><?php echo $result->userName; ?></td>
                          <td>
                            <?php                             
                              while(!empty($pid[$i]))
                              {
                                echo $pid[$i];
                                ++$i;
                            ?> , 
                            <?php
                              }
                              $i=0;
                            ?>
                          </td>
                          <td>
                            <?php                             
                              while(!empty($pquant[$i]))
                              {
                                echo $pquant[$i]; 
                                ++$i;
                             ?> , 
                            <?php
                              }
                              $i=0;
                            ?>
                          </td>
                          <td><?php echo $result->orderDate; ?></td>
                          <td><?php echo $result->paymentMethod; ?></td>                     
                          <td>
                            <?php
                                      if($result->orderStatus==4)
                                      {
                                    ?> 
                                        <p style="color: green;text-align: center;font-weight: 500;">
                                          Delivered</p>
                                    <?php
                                      }
                                    ?>  
                          </td>
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