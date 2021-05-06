<div class="top-bar animate-dropdown">
  <div class="container">
    <div class="header-top-inner">
      <div class="cnt-account">
        <ul class="list-unstyled">
          <li><a href=""><i class="icon fa fa-user"></i>Welcome - <?php echo $_SESSION['uname']; ?> </a></li>
          <li><a href="my-account/account.php"><i class="icon fa fa-user"></i>My Account</a></li>
          <li><a href="my-wishlist.php"><i class="icon fa fa-heart"></i>Wishlist</a></li>
          <li><a href="my-cart.php"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>  
        </ul>
      </div><!-- /.cnt-account -->

      <div class="cnt-block">        

        <script type="text/javascript">
          function remove_product(val) 
          {
            var request = new XMLHttpRequest();
            request.onreadystatechange = function() {
              if(this.readyState === 4 && this.status === 200){
                alert("Product removed from cart successfully!");
                location.reload(); 
              }
              if(this.readyState === 4 && this.status === 204){
                alert("Product could not be removed from cart!");
                location.reload(); 
              }
            };
            request.open("GET", "delete-from-cart.php?product_id="+val , true);
            request.send();
          }

          function showmenu()
          {
            var x = document.getElementById("cart-menu");
            if (x.style.display === "none") {
              x.style.display = "block";
            } 
            else {
              x.style.display = "none";
            }               
          }
        </script>

<?php

$userid=$_SESSION['uid'];
$sql="SELECT ct.userid,ct.productid,ct.productName,ct.productPrice,ct.shippingCharge,ct.productQuantity,ct.coupon,prod.productImage1 from cart ct join products prod on ct.productid=prod.productid where ct.userid=:userid";
$query = $dbh->prepare($sql);
$query->bindParam(':userid',$userid,PDO::PARAM_STR);    
$query->execute();  
$results=$query->fetchAll(PDO::FETCH_OBJ);
$count=$query->rowCount();
?>
        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" onclick="showmenu()"><i class="fa fa-shopping-cart"></i> <?php echo $count; ?><span class="caret"></span></a>
      </div>            
      <div class="clearfix"></div>
    </div>
  </div>
</div>

<?php
if($query->rowCount() > 0)
{
?>
              <div class="container" id="cart-menu">
                <div class="table-responsive">
                  <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th scope="col" style="text-align: center; font-weight: 600;font-size: 16px;">Product Name</th>
                        <th scope="col" style="text-align: center; font-weight: 600;font-size: 16px;">Product Image</th>
                        <th scope="col" style="text-align: center; font-weight: 600;font-size: 16px;">Quantity</th>
                        <th scope="col" style="text-align: center; font-weight: 600;font-size: 16px;">Total</th>
                        <th scope="col" style="text-align: center; font-weight: 600;font-size: 16px;">Remove</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
  foreach($results as $result)
  {

?>                     
                        <tr>              
                          <td style="text-align: center; font-weight: 500;font-size: 16px;"><?php echo $result->productName; ?></td>
                          <td><img src="admin/productimages/<?php echo $result->productid; ?>/<?php echo $result->productImage1; ?>" alt="" class="mCS_img_loaded" style="width: 50px;height: 70px;margin-left: 30%;"></td>
                          <td style="text-align: center; font-weight: 500;font-size: 16px;"><?php echo $result->productQuantity; ?></td>
                          <td style="text-align: center; font-weight: 500;font-size: 16px;"><?php echo $result->productPrice; ?></td>
                          <td style="margin-left: 25%;">
                            <button style="margin-left: 30%;" class="fa fa-trash" onclick="remove_product('<?php echo $result->productid; ?>')"></button>
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